<?php
// Copyright (c) 2025-2026 Murilo Gomes <profmugomes.com.br>. All Rights Reserved.
// Licensed under the PolyForm Perimeter License 1.0.1.
// See LICENSE.md for details.

namespace MiPhantLibs\app;

use MiPhantLibs\system\server;

class router
{
    private bool $isFile = false;
    private bool $sNoPHP = false;
    private bool $encontrado = false;
    private string $url = '';
    private mixed $path;
    private mixed $arquivo;

    public function __construct()
    {
        $server = new server();
        $this->path = new path();
        $this->arquivo = new file();
        $this->url = rtrim($server->uri());

        if (!empty($this->url)) {
            if ($this->url !== '/') {
                if (file_exists($this->path->join($server->documentroot(), $this->url))) {
                    if ($this->arquivo->checkExtension($this->url, 'php')) {
                        include_once($this->path->join($server->documentroot(), $this->url));
                    }
                    $this->isFile = true;
                }
            }
        }
    }

    public function __toString()
    {
        return $this->encontrado;
    }

    public function noPHP()
    {
        return $this->sNoPHP;
    }

    public function get(string|array $path, mixed $function = false): bool
    {
        if (!$this->isFile) {
            $sURL = '/' . trim($this->url, '/');
            $paths = is_array($path) ? $path : [$path];

            foreach ($paths as $p) {
                if ($p === '404') {
                    continue;
                }

                $pFormatado = '/' . trim($p, '/');

                // Converte {qualquer_coisa} para uma captura de texto interna
                // Exemplo: "/usuario/{id}" vira "^/usuario/([^/]+)$"
                $pattern = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([^/]+)', $pFormatado);
                $pattern = '#^' . $pattern . '$#';

                if (preg_match($pattern, $sURL, $matches)) {
                    if (!$this->encontrado) {
                        $this->encontrado = true;

                        if (is_callable($function)) {
                            // Remove o primeiro item ($matches[0] é a URL inteira)
                            array_shift($matches);

                            // Executa a função passando os valores da URL como parâmetros
                            call_user_func_array($function, $matches);
                        }
                        return true;
                    } else {
                        return false;
                    }
                }
            }

            // Lógica para tratar Rota 404
            if (!$this->encontrado && in_array('404', $paths, true)) {
                if (is_callable($function)) {
                    $function();
                }
                return true;
            }

            return false;
        } else {
            if ($this->arquivo->checkExtension($this->url, 'php')) {
                return true;
            } else {
                $this->sNoPHP = true;
                return false;
            }
        }
    }
}
