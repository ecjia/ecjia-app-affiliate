<?php

namespace Ecjia\App\Affiliate;

use Royalcms\Component\App\AppServiceProvider;

class AffiliateServiceProvider extends  AppServiceProvider
{
    
    public function boot()
    {
        $this->package('ecjia/app-affiliate');
    }
    
    public function register()
    {
        
    }
    
    
    
}