<?php

namespace App\Factory;

use App\Entity\Filliere;
use App\Repository\FilliereRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Filliere>
 *
 * @method        Filliere|Proxy create(array|callable $attributes = [])
 * @method static Filliere|Proxy createOne(array $attributes = [])
 * @method static Filliere|Proxy find(object|array|mixed $criteria)
 * @method static Filliere|Proxy findOrCreate(array $attributes)
 * @method static Filliere|Proxy first(string $sortedField = 'id')
 * @method static Filliere|Proxy last(string $sortedField = 'id')
 * @method static Filliere|Proxy random(array $attributes = [])
 * @method static Filliere|Proxy randomOrCreate(array $attributes = [])
 * @method static FilliereRepository|RepositoryProxy repository()
 * @method static Filliere[]|Proxy[] all()
 * @method static Filliere[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Filliere[]|Proxy[] createSequence(iterable|callable $sequence)
 * @method static Filliere[]|Proxy[] findBy(array $attributes)
 * @method static Filliere[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static Filliere[]|Proxy[] randomSet(int $number, array $attributes = [])
 */
final class FilliereFactory extends ModelFactory
{
    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services
     *
     * @todo inject services if required
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */
    protected function getDefaults(): array
    {
        return [
            'designation' => self::faker()->text(20),
        ];
    }

    /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
     */
    protected function initialize(): self
    {
        return $this
            // ->afterInstantiate(function(Filliere $filliere): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Filliere::class;
    }
}
