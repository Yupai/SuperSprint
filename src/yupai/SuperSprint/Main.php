<?php

namespace yupai\SuperSprint;

use pocketmine\plugin\PluginBase;
use pocketmine\entity\Effect;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerToggleSprintEvent;
use pocketmine\event\player\PlayerToggleSneakEvent;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\utils\TextFormat;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener {

    public function OnEnable(){
        $this->saveDefaultConfig();
        $this->reloadConfig();
        $this->getServer()->getPluginManager()->registerEvents($this ,$this);
        $this->getLogger()->info(TextFormat::GREEN . "SuperSprint by Yupai Enable!");
    }

    public function OnDisable(){
        $this->getLogger()->info(TextFormat::RED . "SuperSprint by Yupai Disable!");
    }

    public function onSprinting(PlayerToggleSprintEvent $event){
        $player = $event->getPlayer();
        $ss = $this->getConfig();
        $duration = $ss->get("Duration");
        $amplifier = $ss->get("Amplifier");
        $visible = $ss->get("Visible");
 
//Speed effect

        $speed = Effect::getEffect(Effect::SPEED);
        $speed->setDuration($duration * 20);
        $speed->setAmplifier($amplifier);
        $speed->setVisible($visible); 

           if($player->hasPermission("super.sprint") and $player->isSprinting()){
            $player->addEffect($speed);
           }
    }

     public function onSneak(PlayerToggleSneakEvent $ev){
        $player = $ev->getPlayer();
           
           if($player->hasPermission("super.sprint") and $player->isSneaking()){
            $player->removeEffect(1);
           }
     }
}
