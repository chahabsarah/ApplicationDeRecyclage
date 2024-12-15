<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class EtatCollecte extends Enum
{
const RECOVERED = 'RECOVERED';
const SORTING = 'SORTING';
const RECYCLING = 'RECYCLING';
const RECYCLING_COMPLETED = 'RECYCLING_COMPLETED';
const DISTRIBUTION = 'DISTRIBUTION';

}
