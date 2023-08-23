<?php

namespace App\Helpers;

class TindakanSurat
{
    const ARSIP = 0;
    const REVISI = 1;
    const TERUSKAN = 2;
    const TINDAK_LANJUT = 3;
    const DISPOSISI = 4;
    const SELESAI = 5;

    public function toBadge($status)
    {
        $statusText = self::toString($status);
        $badgeColor = self::getBadgeColor($status);

        return "<span class=\"badge badge-$badgeColor\">$statusText</span>";
    }

    public function toString($status)
    {
        switch ($status) {
            case self::ARSIP:
                return "Arsip";
            case self::REVISI:
                return "Revisi";
            case self::TERUSKAN:
                return "Diteruskan";
            case self::TINDAK_LANJUT:
                return "Tindak Lanjut";
            case self::DISPOSISI:
                return "Disposisi";
            case self::SELESAI:
                return "Arsip";
        }
    }

    public function getBadgeColor($status)
    {
        switch ($status) {
            case self::ARSIP:
                return "success";
            case self::REVISI:
                return "warning";
            case self::TERUSKAN:
                return "info";
            case self::DISPOSISI:
            case self::TINDAK_LANJUT:
                return "primary";
                case self::SELESAI:
                    return "success";
            default:
                return "secondary";
        }
    }
}
