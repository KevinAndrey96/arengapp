<?php

declare(strict_types=1);

namespace Arengapp\Domain;

enum Category: string
{
    case Nacional = 'nacional';
    case Estudiantes = 'estudiantes';
    case Feministas = 'feministas';

    public function label(): string
    {
        return match ($this) {
            self::Nacional => 'Paro nacional',
            self::Estudiantes => 'Movimiento estudiantil',
            self::Feministas => 'Movimiento feminista',
        };
    }

    public function coverPath(): string
    {
        return '/assets/covers/' . $this->value . '.png';
    }
}
