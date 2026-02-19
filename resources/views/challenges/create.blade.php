<x-app-layout>
    <x-slot name="header">
        <h2 style="font-family:'JetBrains Mono',monospace; font-size:1rem; font-weight:700; color:var(--green);">
            🚩 Vendre un nouveau challenge
        </h2>
    </x-slot>

    <div style="padding:2rem 0;">
        <div style="max-width:680px; margin:0 auto; padding:0 1.5rem;">
            <div class="glass-card" style="padding:2rem;">

                <form method="POST" action="{{ route('challenges.store') }}" enctype="multipart/form-data" style="display:flex; flex-direction:column; gap:1.25rem;">
                    @csrf

                    <div>
                        <label style="display:block; margin-bottom:0.4rem;">Titre du challenge</label>
                        <input type="text" name="title" id="title" style="width:100%; padding:0.65rem 0.9rem; font-family:'JetBrains Mono',monospace;" placeholder="Super SQL Injection" required>
                        @error('title')<span style="color:#f85149; font-size:0.78rem;">{{ $message }}</span>@enderror
                    </div>

                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
                        <div>
                            <label style="display:block; margin-bottom:0.4rem;">Catégorie</label>
                            <select name="category" id="category" style="width:100%; padding:0.65rem 0.9rem; font-family:'JetBrains Mono',monospace;">
                                <option value="Web">Web</option>
                                <option value="Pwn">Pwn</option>
                                <option value="Reversing">Reversing</option>
                                <option value="Crypto">Crypto</option>
                                <option value="Forensic">Forensic</option>
                            </select>
                        </div>

                        <div>
                            <label style="display:block; margin-bottom:0.4rem;">Difficulté</label>
                            <select name="difficulty" id="difficulty" style="width:100%; padding:0.65rem 0.9rem; font-family:'JetBrains Mono',monospace;">
                                <option value="Easy">Easy</option>
                                <option value="Medium">Medium</option>
                                <option value="Hard">Hard</option>
                                <option value="Insane">Insane</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label style="display:block; margin-bottom:0.4rem;">Prix (€)</label>
                        <input type="number" step="0.01" name="price" id="price" style="width:100%; padding:0.65rem 0.9rem; font-family:'JetBrains Mono',monospace;" placeholder="10.00" required>
                        @error('price')<span style="color:#f85149; font-size:0.78rem;">{{ $message }}</span>@enderror
                    </div>

                    <div>
                        <label style="display:block; margin-bottom:0.4rem;">Flag (réponse)</label>
                        <input type="text" name="flag_hash" id="flag_hash" style="width:100%; padding:0.65rem 0.9rem; font-family:'JetBrains Mono',monospace;" placeholder="flag{...}" required>
                        <p style="color:var(--text-muted); font-size:0.75rem; margin-top:0.35rem;">* Le flag sera stocké de manière sécurisée (hashé).</p>
                    </div>

                    <div>
                        <label style="display:block; margin-bottom:0.4rem;">Fichier du challenge (optionnel)</label>
                        <input type="file" name="challenge_file" id="challenge_file" style="width:100%; padding:0.65rem 0.9rem; font-size:0.82rem;">
                        <p style="color:var(--text-muted); font-size:0.75rem; margin-top:0.35rem;">* Formats: .zip, .tar, .gz, .txt, .pdf, .exe, .bin (Max: 20MB)</p>
                        @error('challenge_file')<span style="color:#f85149; font-size:0.78rem;">{{ $message }}</span>@enderror
                    </div>

                    <div>
                        <label style="display:block; margin-bottom:0.4rem;">Description</label>
                        <textarea name="description" id="description" rows="5" style="width:100%; padding:0.65rem 0.9rem; font-family:'JetBrains Mono',monospace; resize:vertical;" required></textarea>
                        @error('description')<span style="color:#f85149; font-size:0.78rem;">{{ $message }}</span>@enderror
                    </div>

                    <div style="display:flex; justify-content:flex-end; padding-top:0.5rem;">
                        <button type="submit" class="btn-green" style="padding:0.75rem 2rem; font-size:0.9rem;">
                            🚀 Publier le challenge
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>