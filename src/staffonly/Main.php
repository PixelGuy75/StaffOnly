<?php

namespace staffonly;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\server\DataPacketReceiveEvent;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;
use pocketmine\network\protocol\LoginPacket;

class Main extends PluginBase implements Listener {
    
    public function onEnable() {
        $this->mode = false;
        if($this->getConfig()->get("mode") === true){
            $this->mode = true;
        }
        $this->getLogger()->info(TextFormat::GOLD."Staff Only Enabled");
    }
    
    public function onDataPacketReceive(DataPacketReceiveEvent $event) {
        if($event->getPacket() instanceof LoginPacket){
            if($this->mode === true && !$event->getPlayer()->isOp()){
                $event->setCancelled(true);
                $event->getPlayer()->close("", $this->getConfig()->get("quit-message"));
            }
        }
    }
    
    public function enableStaff(CommandSender $sender) {
        $this->mode = true;
        $sender->sendMessage("Enabled StaffOnly");
    }
    
    public function disableStaff(CommandSender $sender) {
        $this->mode = false;
        $sender->sendMessage("Disabled StaffOnly");
    }
    
    public function onCommand(CommandSender $sender, Command $command, $label, array $args) {
        if($sender->isOp()){
            switch($command->getName()){
                case "staffonlyon":
                    $this->enableStaff($sender);
                    break;
                case "staffonlyoff":
                    $this->disableStaff($sender);
                    break;
            }
        }
    }
}   
