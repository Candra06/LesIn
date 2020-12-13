<?php
namespace App\Helpers;

class Helper
{
    public static function tanggal($tgl)
    {
        $qq = '';
        $k = explode("-", $tgl);
        $bln = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
        $qq = $k[2] . ' ' . $bln[(int)$k[1]] . ' ' . $k[0];
        return $qq;
    }
    public static function bulantahun($tgl)
    {
        $qq = '';
        $k = explode("-", $tgl);
        $bln = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
        $qq = $bln[(int)$k[1]] . ' ' . $k[0];
        return $qq;
    }
    public static function waktu($tgl)
    {
        $qq = '';
        
        $k = explode(" ", $tgl);
        $kk = explode("-", $k[0]);
        $bln = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');

        $qq = $kk[2] . ' ' . $bln[(int)$kk[1]] . ' ' . $kk[0] . ' ' . $k[1];
        return $qq;
    }

    public static function gettanggaldatetime($tgl)
    {
        $qq = '';
        $k = explode(" ", $tgl);
        $kk = explode("-", $k[0]);
        $bln = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');

        $qq = $kk[2] . ' ' . $bln[(int)$kk[1]] . ' ' . $kk[0];
        return $qq;
    }

    public static function bersihkanangka($kalimat)
    {
        $re = array();
        $re[0] = ".";
        $re[1] = ",";
        $re[2] = "-";
        $dat = array();
        $dat[0] = "";
        $dat[1] = "";
        $dat[2] = "";
        return str_replace($re, $dat, $kalimat);
    }
}
