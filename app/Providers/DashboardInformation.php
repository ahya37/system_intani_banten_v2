<?php

namespace App\Providers;

use App\Farmer;
use App\Capital;
use App\Management;
use App\AgriculturalGroup;
use Illuminate\Support\ServiceProvider;

class DashboardInformation extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    public function __construct()
    {
        
    }

    public function getModel()
    {
        $managementModel = new Management();
        $farmerModel = new Farmer();
        $capitalModel = new Capital();
        $agriculturalGroupModel = new AgriculturalGroup();

        $model = [
                  'managementModel' => $managementModel,
                  'farmerModel' => $farmerModel,
                  'capitalModel' => $capitalModel,
                  'agriculturalGroupModel' => $agriculturalGroupModel
                ];

        return $model;
        
    }

    public function getDashboardManagement($manager)
    {
        #mendefinisikan model
        $model  = $this->getModel();
        $managementModel        = $model['managementModel'];
        $farmerModel            = $model['farmerModel'];
        $agriculturalGroupModel = $model['agriculturalGroupModel'];
        $capitalModel           = $model['capitalModel'];

        #jumlah investor
         $investor        = $managementModel->getInvestorByManagement($manager);
         $total_investor  = count($investor);

         #jumlah petani
         $farmer      = $farmerModel->getFarmerByManagement($manager);
         $total_farmer  = count($farmer);

         #jumlah kelompok pertanian
         $agriculture_group     = $agriculturalGroupModel->getAgriculturGroupByManagement($manager);
         $total_agriculture_group = count($agriculture_group);

         #jumlah seluruh nominal permodalan yang di kelolanya
         $total_capital= $capitalModel->getInvestorAndTotalCapitalByManagement($manager);

         $data = [
             'total_investor' => $total_investor, 
             'total_farmer' => $total_farmer,
             'total_agriculture_group' => $total_agriculture_group,
             'total_capital' => $total_capital
            ];

         return $data;
    }

    public function getDashboardInvestor($investor_id)
    {
        #mendefinisikan model
        $model  = $this->getModel();
        $managementModel        = $model['managementModel'];
        $farmerModel            = $model['farmerModel'];
        $agriculturalGroupModel = $model['agriculturalGroupModel'];
        $capitalModel           = $model['capitalModel'];

        $management   = $managementModel->getManagerByInvestor($investor_id);
        $total_management = count($management);

        #jumlah petani
        $investor_farmer = $farmerModel->getFarmerByInvestor($investor_id);
        $total_farmer  = count($investor_farmer);

        #jumlah kelompok pertanian
        $agriculture_group     = $agriculturalGroupModel->getAgriculturGroupByInvestor($investor_id);
        $total_agriculture_group = count($agriculture_group);

        #jumlah seluruh nominal permodalan yang di biayai
        $total_capital= $capitalModel->getInvestorAndTotalCapitalByInvestor($investor_id);

        $data = [
            'total_management' => $total_management,
            'total_farmer' => $total_farmer,
            'total_agriculture_group' => $total_agriculture_group,
            'total_capital' => $total_capital
        ];
        return $data;
        
    }

}
