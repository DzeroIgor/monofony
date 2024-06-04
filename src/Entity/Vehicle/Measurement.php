<?php

namespace App\Entity\Vehicle;

enum Measurement: string
{
    case Gram = 'Gram';
    case Kilogram = 'Kilogram';
    case Tonne = 'Tonne';
}
