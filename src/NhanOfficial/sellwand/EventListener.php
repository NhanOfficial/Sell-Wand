<?php

namespace NhanOfficial\sellwand;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use NhanOfficial\sellwand\Main;
use onebone\economyapi\EconomyAPI;

class EventListener implements Listener{
  
  /** @var Main $main */
  private $main;
  
  public function __construct(Main $main){
    $this->main = $main;
  }
  
  public function onInteract(PlayerInteractEvent $event){
  $player = $event->getPlayer();
  $item = $event->getItem();
  $block = $event->getBlock();
  if($item->getCustomName() === "§r§l§aSell Wand"){
  if($block->getId() === 54){
  $tile = $block->getPosition()->getWorld()->getTile($block->getPosition());
  $items = $tile->getInventory()->getContents();
  $all = [];
  foreach($items as $slot => $item){
  foreach($this->main->sell->get("sell") as $sell){
  $id = explode(".", $sell); //$id[0] = "id", $id[1] = "meta"
  $cost = explode(":", $sell); //$cost[0] = "cost"
  if($item->getId() === ((int)$id[0]) and $item->getMeta() === ((int)$id[1])){
  EconomyAPI::getInstance()->addMoney($player, (((int)$cost[1])*$item->getCount()));
  $all[] = ((int)$cost[1]*$item->getCount());
  $tile->getInventory()->removeItem($item);
  }
  }
  }
  if(count($all) > 0){
  $player->sendMessage("§aSố tiền đã bán được: §e" . array_sum($all));
  }else{
  $player->sendMessage("§cKhông có bất kỳ món đồ nào để bán trong rương cả");
  }
  }else{
  $player->sendMessage("§cThứ chạm vào phải là rương");
  }
  }
  }
}