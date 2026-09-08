<?php
// Copyright (C) 2025-2026 Murilo Gomes <profmugomes.com.br>
// SPDX-License-Identifier: MIT

namespace MiPhantLibs\system;

class platform {
    public function osLinux():bool {
        return PHP_OS_FAMILY === 'Linux';
    }

    public function osWindows():bool {
        return PHP_OS_FAMILY === 'Windows';
    }
}