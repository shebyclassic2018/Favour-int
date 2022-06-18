<?php

namespace App\Services;

use App\Interfaces\Tarrifs\TarrifBroker;
use App\Models\Financials\NgataTarif;

class TarrifsService 
{
  # VISIT 
    ## Public
    public function HandleGetSigleVisitTarrif($status)
    {
      return NgataTarif::where('name' , NgataTarif::RATIOS[NgataTarif::VISITING_RATIO])->where('status', $status)->first();
    }

    public function HandleGetAllVisitTarrifs()
    {                                                                                                                                                                                                                                                                                   
      return NgataTarif::where('name', NgataTarif::RATIOS[NgataTarif::VISITING_RATIO])->get();
    }



    ## =====================================================================================
    ## Protected



  # ========================================================================================
  ## RENTS
    ## Public
    public function HandleGetSigleCommonTarrif($status)
    {
      return NgataTarif::where('name' , NgataTarif::RATIOS[NgataTarif::NORMAL_COM_RATIO])->where('status', $status)->first();
    }

    public function HandleGetSigleContinuingTarrif($status)
    {
      return NgataTarif::where('name', NgataTarif::RATIOS[NgataTarif::CONTIN_COM_RATIO])->where('status', $status)->first();
    }

    public function HandleGetAllCommonTarrifs()
    {                                                                                                                                                                                                                                                                                   
      return NgataTarif::where('name', NgataTarif::RATIOS[NgataTarif::NORMAL_COM_RATIO])->get();
    }







    ## =====================================================================================
    ## Protected


   ## RENTS
    ## Public
    public function HandleGetSigleLinkedTarrif($status)
    {
      return NgataTarif::where('name' , NgataTarif::RATIOS[NgataTarif::LINKED_COM_RATIO])->where('status', $status)->first();
    }

    public function HandleGetAllLinkedTarrifs()
    {                                                                                                                                                                                                                                                                                   
      return NgataTarif::where('name', NgataTarif::RATIOS[NgataTarif::LINKED_COM_RATIO])->get();
    }







    ## =====================================================================================
    ## Protected




  # ========================================================================================
  ## SHARED
    ## Public
    public function HandleCreateTarrif() {
      
    }

    public function HandleTarrifsList() {
      return NgataTarif::all();
    }


    public function HandleVisitDistribution($disbasments, $amount) {
      # 'initiator'|'system' | 'guider' | 'linker' 
      #   0        | 50.00	 |   50.00	|    0 

      $ratios   = [];
      $involved = [TarrifBroker::INITIATOR, TarrifBroker::SYSTEM, TarrifBroker::GUIDER, TarrifBroker::LINKER];
      foreach ($disbasments as $key => $disbasment) {
        $tarif = $this->HandleSingleTarrifByID($disbasment->tarif_id);
        foreach ($tarif->toArray() as $key => $value) {
          if (!is_null($value) && in_array($key, $involved)) {
            $ratios[$key]['ratio']   = (int)$value;
            $ratios[$key]['ammount'] = $this->calculateRationOverAmmount((int)$value, $amount);
          }
        }
      }
      return json_encode($ratios);
    }

    public function calculateRationOverAmmount($percent, $amount)
    {
      return round(($percent * $amount / 100), 2);
    }

    public function HandleSingleTarrifByID($id)
    {
      return NgataTarif::findOrFail($id);

    }


    ## =====================================================================================
    ## Private



    ## =====================================================================================
    ## Protected





    ## =====================================================================================


  
}
