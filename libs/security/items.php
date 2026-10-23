<?php
// Copyright (C) 2025-2026 Murilo Gomes <profmugomes.com.br>
// SPDX-License-Identifier: MIT

// Site: https://www.profmugomes.com.br

namespace MiPhantLibs\security;

class items {
    public function clean(?string $value, int $flags = ENT_QUOTES|ENT_SUBSTITUTE, ?string $encoding = 'UTF-8', bool $double_encode = true) : string|int|null {
        return htmlspecialchars($value, $flags, $encoding, $double_encode);
    }
}
