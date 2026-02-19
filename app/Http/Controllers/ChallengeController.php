<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChallengeController extends Controller
{
    /**
     * 메인 화면 (index.php 대체)
     * 모든 챌린지 목록을 가져와서 welcome 뷰에 전달
     */
    public function index()
    {
        // Récupérer par ordre chronologique inverse, y compris les informations de l'auteur
        $challenges = Challenge::with('author')->orderBy('created_at', 'desc')->get();
        return view('welcome', compact('challenges'));
    }

    /**
     * 상품 등록 폼 보여주기 (sell.php 화면 대체)
     */
    public function create()
    {
        return view('challenges.create');
    }

    /**
     * 상품 DB에 저장하기 (sell.php 로직 대체)
     */
    public function store(Request $request)
    {
        // 1. Validation (vérification des champs obligatoires)
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'difficulty' => 'required|string',
            'price' => 'required|numeric|min:0',
            'flag_hash' => 'required|string',
            'description' => 'required|string',
            'challenge_file' => 'nullable|file|mimes:zip,tar,gz,txt,pdf,exe,bin|max:20480',
        ]);

        // 👇 추가된 부분: 파일 처리 로직 👇
        $filePath = null;
        if ($request->hasFile('challenge_file')) {
            // 파일을 storage/app/challenges 폴더에 안전하게 저장 (외부 직접 접근 불가)
            $filePath = $request->file('challenge_file')->store('challenges');
        }
        // 👆 추가된 부분 끝 👆

        // 2. Sauvegarde dans la base de données
        Challenge::create([
            'title' => $request->title,
            'category' => $request->category,
            'difficulty' => $request->difficulty,
            'price' => $request->price,
            'flag_hash' => hash('sha256', $request->flag_hash), // Le flag est chiffré par hash
            'description' => $request->description,
            'author_id' => Auth::id(), // ID de l'utilisateur connecté
            'image_url' => 'default.png',
            'file_path' => $filePath, // 👈 DB에 저장된 파일 경로 기록
            'is_active' => true,
        ]);

        // 3. Redirection vers le tableau de bord après la réussite
        return redirect()->route('home')->with('success', 'Challenge created successfully!');
    }
}