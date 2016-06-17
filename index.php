<?php

interface IBeing
{
    public function getName();

    public function downXp($value);

    public function ISLive();
}

class Being implements IBeing
{
    private $name;
    private $hp;

    public function __construct($name, $hp)
    {
        $this->name = $name;
        $this->hp = $hp;
    }
    public function hp(){
        return $this->hp;
    }
    public function ISLive()
    {
        return $this->hp > 0;
    }

    public function getName()
    {
        return $this->name;
    }

    public function downXp($value)
    {
        return $this->hp -= $value;
    }

}

interface IBattle
{
    public function addBeing(IBeing $being);

    public function selected();

}

class Battle implements IBattle
{
    public $beings;

    public function addBeing(IBeing $being)
    {
        return $this->beings[] = $being;
    }

    public function selected(){
        $count=count($this->beings);
        if($count==1){
            echo (array_pop($this->beings)->getName()).' - Победил';
            return true;
        }
        $attacher_id=array_rand($this->beings);
        $attaker=$this->beings[$attacher_id]; //random attacker object
        do{
            $loozer_id=array_rand($this->beings);
        }while($loozer_id==$attacher_id);
        $loozer=$this->beings[$loozer_id]; //another random unique object
        $this->fight($attaker,$loozer);

    }

    private function fight($attaker,$loozer)
    {
        $hp=rand(1,100);
        $block=rand(0,100);
        $critical=rand(0,100);
        $g=null;
        if ($critical<10){
            $hp=$hp*round(1.1 + mt_rand() / mt_getrandmax() * (5.5 - 1.1),1);
           $g='Крит';
        }
        if($block>85){
        $hp=0;
            $g='блок';
    }
        $loozer->downXp($hp);
        echo $attaker->getName().' бьет '. $loozer->getName().' на '. $hp.'хп, осталось ( '.$loozer->hp(). ' хп)'.$g."\n";
        if (!$loozer->ISLive()){
            unset($this->beings[ array_search($loozer,$this->beings)]);
            echo $loozer->getName().' - был убит!'."\n";
        }
        $this->selected();
    }
}
$being= new Being('Алёша',300);
$being1= new Being('Татьянка',300);
$being2= new Being('Кощей',300);
$battle=new Battle();
$battle->addBeing($being);
$battle->addBeing($being1);
$battle->addBeing($being2);
$battle->selected();
