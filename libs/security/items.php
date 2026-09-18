<?php
// Copyright (c) 2025-2026 Murilo Gomes <profmugomes.com.br>. All Rights Reserved.
// Licensed under the PolyForm Perimeter License 1.0.1.
// See LICENSE.md for details.

namespace MiPhantLibs\security;

class items {
    public function clean(?string $value, int $flags = ENT_QUOTES|ENT_SUBSTITUTE, ?string $encoding = 'UTF-8', bool $double_encode = true) : string|int|null {
        return htmlspecialchars($value, $flags, $encoding, $double_encode);
    }
}
