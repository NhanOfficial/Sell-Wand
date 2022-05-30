<?php

namespace NhanOfficial\sellwand;

use pocketmine\player\Player;
use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginOwned;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\item\VanillaItems;
use NhanOfficial\sellwand\Main;

class SellwandCommand extends Command implements PluginOwned{
  
  /** @var Main $main */
  private $main;
  
  public function __construct(Main $main){
  $this->main = $main;
  parent::__construct("sellwand", "Lấy gậy sell wand", null, ["sellwand", "sw"]);
  $this->setPermission("sellwand.use.command");
  }
  
  public function execute(CommandSender $player, String $label, array $args): bool{
    if($player instanceof Player){
    if($this->testPermission($player)){
    $stick = VanillaItems::BLAZE_ROD();
    $stick->setCustomName("§r§l§aSell Wand");
    $stick->setLore(["§r§l§7Cách dùng: Đập gậy vô rương để bán đồ"]);
    if($player->getInventory()->canAddItem($stick)){
    $player->getInventory()->addItem($stick);
    $player->sendMessage("§aĐã thêm gậy Sell Wand");
    }else{
    $player->sendMessage("§cTúi đồ của bạn không đủ chỗ để thêm Gậy Sell Wand");
    }
    }
    }
    return true;
  }
  
  public function getOwningPlugin() : Plugin{
    return $this->main;
  }
}
