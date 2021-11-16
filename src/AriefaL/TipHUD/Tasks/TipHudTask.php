<?php namespace AriefaL\TipHUD\Tasks;

use pocketmine\Player;
use pocketmine\scheduler\Task;
use pocketmine\utils\TextFormat as TE;
use pocketmine\utils\Config;
use AriefaL\TipHUD\Main;

class TipHudTask extends Task {

    /** @var Main */
    private $main;
    /** @var array */
    private $config;

    public function __construct(Main $main, array $config) {
        $this->main = $main;
        $this->config = $config;
    }
    
    /**
     * @param integer $currentTick
     * @return void
     */
    public function onRun(int $currentTick) {
        foreach($this->main->getServer()->getOnlinePlayers() as $player) {
            if($player instanceof Player){
                if (isset($this->main->statusTip[$player->getName()])) {
                    $player->sendTip($this->translate($player, $this->config["format"]));
                }
            }
        }
    }
    
    /**
     * @param Player $player
     * @return void
     */
    public function getPlayerMoney(Player $player) {
        $economyAPI = $this->main->getServer()->getPluginManager()->getPlugin("EconomyAPI");
        if ($economyAPI !== null) {
            return $economyAPI->myMoney($player);
        } else {
            return "Plugin not found";
        }
    }
    
    /**
     * @param Player $player
     * @return string
     */
    public function getPlayerRank(Player $player): string {
        $purePerms = $this->main->getServer()->getPluginManager()->getPlugin("PurePerms");
        if ($purePerms !== null) {
            $group = $purePerms->getUserDataMgr()->getData($player)['group'];
            if ($group !== null) {
                return $group;
            } else {
                return "No Rank";
            }
        } else {
            return "Plugin not found";
        }
    }
    
    /**
     * @param Player $player
     * @param string $message
     * @return string
     */
    public function translate(Player $player, string $message): string {
        $message = str_replace([
            "{time}",
            "{h}",
            "{i}",
            "{s}",
            "{date}",
            "{d}",
            "{m}",
            "{y}",
            "&",
            "{health}",
            "{max_health}",
            "{name}",
            "{display_name}",
            "{money}",
            "{online}",
            "{max_online}",
            "{rank}",
            "{item_name}",
            "{item_id}",
            "{item_meta}",
            "{item_count}",
            "{x}",
            "{y}",
            "{z}",
            "{load}",
            "{tps}",
            "{level_name}",
            "{level_folder_name}",
            "{ip}",
            "{ping}",
            "{random_color}"
        ], [
            date("H:i:s"),
            date("H"),
            date("i"),
            date("s"),
            date("d-m-Y"),
            date("d"),
            date("m"),
            date("Y"),
            "§",
            round($player->getHealth()),
            $player->getMaxHealth(),
            $player->getName(),
            $player->getDisplayName(),
            $this->getPlayerMoney($player),
            count($this->main->getServer()->getOnlinePlayers()),
            $this->main->getServer()->getMaxPlayers(),
            $this->getPlayerRank($player),
            $player->getInventory()->getItemInHand()->getName(),
            $player->getInventory()->getItemInHand()->getId(),
            $player->getInventory()->getItemInHand()->getDamage(),
            $player->getInventory()->getItemInHand()->getCount(),
            round($player->getX()),
            round($player->getY()),
            round($player->getZ()),
            $this->main->getServer()->getTickUsage(),
            $this->main->getServer()->getTicksPerSecond(),
            $player->getLevel()->getName(),
            $player->getLevel()->getFolderName(),
            $player->getAddress(),
            $player->getPing(),
            $this->getColor()
        ], $message);
        return $message;
    }
    
    /**
     * @return string
     */
    public function getColor(): string {
        $colors = [TE::DARK_BLUE, TE::DARK_GREEN, TE::DARK_AQUA, TE::DARK_RED,
                TE::DARK_PURPLE, TE::GOLD, TE::GRAY, TE::DARK_GRAY, TE::BLUE,
                TE::GREEN, TE::AQUA, TE::RED, TE::LIGHT_PURPLE, TE::YELLOW, TE::WHITE];
        return $colors[rand(0, 14)];
    }
}
