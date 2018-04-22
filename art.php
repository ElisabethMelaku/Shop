<?php
/**
 * Created by PhpStorm.
 * User: emela
 * Date: 21/04/2018
 * Time: 11:53
 */

namespace Klasse\art;

class art
{
    protected $name;
    protected $material;
    protected $durchmesser;

    /**
     * Flag constructor.
     * @param string $name
     * @param float $durchmesser
     * @param string $material
     */
    function __construct(string $name, float $durchmesser,  string $material)
    {
        $this->name = $name;
        $this->material = $material;
        $this->durchmesser = $durchmesser;
    }

    public function calculateVolumen(): float
    {
        return (4/3)*($this->durchmesser/2)*($this->durchmesser/2)*($this->durchmesser/2) * 3.14;
        //3/4 * r³ * Pi
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getMaterial(): string
    {
        return $this->material;
    }

    /**
     * @return float
     */
    public function getDurchmesser(): float
    {
        return $this->durchmesser;
    }

    function __toString() : string{
        // TODO: Implement __toString() method.
        $tmp = $this->calculateVolumen();

        $rv = <<<EOT
            Name: $this->name <br />
            Material: $this->material <br />
            Durchmesser: $this->durchmesser <br />
            Volumen: $tmp
            <br />
EOT;
        return $rv;
    }
}