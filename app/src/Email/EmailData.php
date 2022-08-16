<?php

use SilverStripe\ORM\DataObject;
use SilverStripe\ORM\FieldType\DBField;

class EmailData extends DataObject
{
    private static $db = [
        'Layanan' => 'Varchar',
        'Nama' => 'Varchar',
        'Telp' => 'Varchar',
        'Pesan' => 'Varchar'
    ];

    private static $summary_fields = [
        'Created',
        'Nama',
        'Pesan',
        'chatWaPhone' => 'WhatsApp'
    ];

    private static $default_sort = "Created DESC";

    public function chatWaPhone()
    {
        $textPesan = "https://api.whatsapp.com/send?phone=".$this->Telp."&text=Halo ".$this->Nama." Ada yang bisa saya bantu 🙂";
        return DBField::create_field('HTMLText', "<a href='".$textPesan."' target='_blank' class='btn btn-success' > Kirim Whatsapp </a>");
    }

    public function formatPhone($nohp)
    {
        // kadang ada penulisan no hp 0811 239 345
        $nohp = str_replace(" ","",$nohp);
        // kadang ada penulisan no hp (0274) 778787
        $nohp = str_replace("(","",$nohp);
        // kadang ada penulisan no hp (0274) 778787
        $nohp = str_replace(")","",$nohp);
        // kadang ada penulisan no hp 0811.239.345
        $nohp = str_replace(".","",$nohp);

        // cek apakah no hp mengandung karakter + dan 0-9
        if(!preg_match('/[^+0-9]/',trim($nohp))){
            // cek apakah no hp karakter 1-3 adalah +62
            if(substr(trim($nohp), 0, 3)=='+62'){
                $hp = trim($nohp);
            }
            // cek apakah no hp karakter 1 adalah 0
            elseif(substr(trim($nohp), 0, 1)=='0'){
                $hp = '+62'.substr(trim($nohp), 1);
            }
        }
        return $hp;
    }
}
