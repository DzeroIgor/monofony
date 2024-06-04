<?php

namespace App\Entity\Vehicle;

enum BodyType: string
{
    case Micro = 'Micro';
    case Hatchback = 'Hatchback';
    case Sedan = 'Sedan';
    case Convertible = 'Convertible';
    case Wagon = 'Wagon';
    case Coupe = 'Coupe';
    case Luxury = 'Luxury';
    case SportCar = 'Sport Car';
    case Supercar = 'Supercar';

}
