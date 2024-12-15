<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class TypeDechet extends Enum
{
    const PLASTIC = 'PLASTIC';
    const WOOD = 'WOOD';
    const PAPER = 'PAPER';
    const METAL = 'METAL';
    const GLASS = 'GLASS';
    const EWASTE = 'E-WASTE';
    const ORGANIC_WASTE = 'ORGANIC_WASTE';
    const TEXTILES = 'TEXTILES';
    const TIRES = 'TIRES';
    const CONSTRUCTION_WASTE = 'CONSTRUCTION_WASTE';
}
