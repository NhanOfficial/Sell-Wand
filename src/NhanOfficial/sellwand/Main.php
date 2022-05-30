<?php

namespace NhanOfficial\sellwand;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use NhanOfficial\sellwand\EventListener;
use NhanOfficial\sellwand\SellwandCommand;

class Main extends PluginBase{
  
  /** @var Config $sell */
  public $sell;
  
  public function onEnable() : void{
  $this->saveResource("sell.yml");
  $this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
  $this->getServer()->getCommandMap()->register("SellWand", new SellwandCommand($this));
  $this->sell = new Config($this->getDataFolder() . "sell.yml", Config::YAML);
  }
}