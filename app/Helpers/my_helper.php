<?php
    // fungsi merubah angka menjadi format rupiah
    function format_rupiah($angka){
        $rupiah=number_format($angka,0,',','.');
        return "Rp ".$rupiah;
    }
?>