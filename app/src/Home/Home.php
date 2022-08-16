<?php

use SilverStripe\SiteConfig\SiteConfig;

class Home extends Page
{

}

class HomeController extends PageController
{
    private static $allowed_actions = [
        'quote',
        'sendMail',
        'getFormModal'
    ];

    public function getFormModal()
    {
        return $this->renderWith('Layout/form_open');
    }

    public function index()
    {
        $aboutUs = Page::get()->filter([
            'ClassName' => 'AboutPage'
        ])->first();

        $service = Page::get()->filter([
            'ClassName' => 'ServicePage'
        ])->first();

        $katalog = Page::get()->filter([
            'ClassName' => 'KatalogPage'
        ])->first();

        $katalogData = Katalog::get()->limit(3);

        return $this->customise([
            'Layout' => $this->customise([
                'AboutUs' => $aboutUs,
                'Service' => $service,
                'ServiceCust' => Service::get(),
                'Katalog' => $katalog,
                'KatalogData' => $katalogData
            ])->renderWith('Layout/Home'),
            'Slider' => Slider::get(),
            'katalog' => Katalog::get(),
            'ShowBanner' => true,
            'Segment' => '/'
        ])->renderWith('Page');
    }

    public function quote()
    {
        return $this->customise([
            'Layout' => $this->renderWith('Layout/Quote'),
            'ShowBanner' => false
        ])->renderWith('Page');
    }

    public function sendMail()
    {
        $siteConfig = SiteConfig::current_site_config();
        $smtpData = [
            'host' => $siteConfig->Host,
            'port' => $siteConfig->Port,
            'username' => $siteConfig->Username,
            'password' => $siteConfig->Password,
            'encrypt' => 'ssl'
        ];

        $mailData = [
            'nama' => $_POST['name'],
            'from' => $siteConfig->Username,
            'telfon' => $_POST['telp'],
            'message' => $_POST['message'],
            'layanan' => $_POST['layanan'],
            'subject' => $_POST['subject'],
            'to' => trim($siteConfig->Email),
            'layout' => $this->customise([
                'nama' => $_POST['name'],
                'telfon' => $_POST['telp'],
                'from' => $siteConfig->Username,
                'subject' => $_POST['subject'],
                'message' => $_POST['message']
            ])->renderWith('Email/ContactUs')
        ];

        $mailConfig = new EmailConfiguration();
        $email = $mailConfig->sendMessage($mailData, $smtpData);
        if($email)
        {
            $saveEmail = EmailData::create();
            $saveEmail->Layanan = $mailData['layanan'];
            $saveEmail->Nama = $mailData['nama'];
            $saveEmail->Telp = $saveEmail->formatPhone($mailData['telfon']);
            $saveEmail->Pesan = $mailData['message'];
            $saveEmail->write();
            return $this->redirectBack();
        } else {
            return "gagal kirim";
        }
    }
}
