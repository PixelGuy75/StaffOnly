<?php

namespace staffonly;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\player\PlayerJoinEvent;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Server;
use pocketmine\utils\TextFormat;

class Main extends PluginBase implements Listener {
    
    public function onEnable() {
        $this->getLogger()->info(TextFormat::GOLD."Staff Only Enabled");
    }
    
    public function onJoin(PlayerJoinEvent $event) {
        
    }
    
    public function enableStaff($sender) {
        $sender->sendMessage("Enabled StaffOnly");
    }
    
    public function disableStaff($sender) {
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