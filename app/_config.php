<?php

use SilverStripe\Admin\CMSMenu;
use SilverStripe\CampaignAdmin\CampaignAdmin;
use SilverStripe\Reports\ReportAdmin;
use SilverStripe\Security\PasswordValidator;
use SilverStripe\Security\Member;
use SilverStripe\SiteConfig\SiteConfig;
use SilverStripe\VersionedAdmin\ArchiveAdmin;

// remove PasswordValidator for SilverStripe 5.0
$validator = PasswordValidator::create();
// Settings are registered via Injector configuration - see passwords.yml in framework
Member::set_password_validator($validator);
SiteConfig::add_extension(SiteExtension::class);

// Remove Menu CMS Admin
CMSMenu::remove_menu_class(CampaignAdmin::class);
CMSMenu::remove_menu_class(ReportAdmin::class);
CMSMenu::remove_menu_class(ArchiveAdmin::class);
