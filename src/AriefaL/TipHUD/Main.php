<?php namespace AriefaL\TipHUD;

use pocketmine\Player;
use pocketmine\event\Listener;
use pocketmine\command\Command;
use pocketmine\plugin\PluginBase;
use pocketmine\command\CommandSender;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerQuitEvent;

class Main extends PluginBase implements Listener {

    /** @var array */
    public $statusTip = [];
    
    public function onEnable(): void {
        if(!file_exists($this->getDataFolder())){
            @mkdir($this->getDataFolder());
        } else if(!file_exists($this->getDataFolder() . "config.yml")){
            $this->getLogger()->info("Config Not Found! Creating new config...");
            $this->saveDefaultConfig();
        }

        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getScheduler()->scheduleRepeatingTask(new Task($this, $this->getConfig()->getAll()), 20);
    }
    
    /**
     * @param CommandSender $player
     * @param Command $command
     * @param string $label
     * @param array $args
     * @return boolean
     */
    public function onCommand(CommandSender $player, Command $command, string $label, array $args): bool {
        if(!$player instanceof Player){
            $player->sendMessage("§cRun Command In Game!");
            return true;
        }
        
        if(!isset($args[0])){
            $player->sendTip("§cType usage: /tiphud <on|off>");
            return true;
        }
        
        if(isset($args[0])){
            switch(strtolower($args[0])){
                case "on":
                    if(!isset($this->statusTip[$player->getName()])){
                        $this->statusTip[$player->getName()] = $player->getName();
                        $player->sendTip("§a> TipHUD activated!");
                        return true;
                    }
                break;
                case "off":
                    if(isset($this->statusTip[$player->getName()])){
                        unset($this->statusTip[$player->getName()]);
                        $player->sendTip("§c> TipHUD deactivated!");
                        return true;
                    }
                break;
                default:
                    $player->sendTip("§cType usage: /tiphud <on|off>");
                    return true;
            }
        }
        return false;
    }

    /**
     * @param PlayerJoinEvent $event
     * @return void
     */
    public function onJoin(PlayerJoinEvent $event){
        $player = $event->getPlayer();
        if ($player instanceof Player) {		
            if (!isset($this->statusTip[$player->getName()])) {
                $this->statusTip[$player->getName()] = $player->getName();
            }
        }
    }

    /**
     * @param PlayerQuitEvent $event
     * @return void
     */
    public function onQuin(PlayerQuitEvent $event) {
        $player = $event->getPlayer();
        if ($player instanceof Player) {		
            if (isset($this->statusTip[$player->getName()])) {
                unset($this->statusTip[$player->getName()]);
            }
        }
    }
}