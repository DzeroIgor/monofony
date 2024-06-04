<?php

namespace App\Entity\Vehicle;

enum EngineType: string
{
    case Diesel = 'Diesel';
    case Hybrid = 'Hybrid';
    case Plug_in_Hybrid = 'Plug-in Hybrid';
    case Electric = 'Electric';
    case Benzine = 'Benzine';
    case Propane = 'Propane';
    case Methane = 'Methane';

}
