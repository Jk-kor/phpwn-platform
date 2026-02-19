<?php

if (! function_exists('ctfCatClass')) {
    /**
     * Retourne la classe CSS de badge selon la catégorie du challenge.
     */
    function ctfCatClass(string $category): string
    {
        $map = [
            'web'       => 'badge-web',
            'pwn'       => 'badge-pwn',
            'crypto'    => 'badge-crypto',
            'forensic'  => 'badge-forensic',
            'forensics' => 'badge-forensic',
        ];
        return $map[strtolower($category)] ?? 'badge-misc';
    }
}

if (! function_exists('ctfDiffClass')) {
    /**
     * Retourne la classe CSS de difficulté selon le niveau du challenge.
     */
    function ctfDiffClass(string $difficulty): string
    {
        $map = [
            'easy'   => 'diff-noob',
            'noob'   => 'diff-noob',
            'medium' => 'diff-mid',
            'mid'    => 'diff-mid',
            'hard'   => 'diff-hard',
            'insane' => 'diff-insane',
        ];
        return $map[strtolower($difficulty)] ?? 'diff-mid';
    }
}
