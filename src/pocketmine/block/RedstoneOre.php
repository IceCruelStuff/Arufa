<?php

 /*
 *                       __   _______                   
 *     /\               / _| |__   __|                  
 *    /  \   _ __ _   _| |_ __ _| | ___  __ _ _ __ ___  
 *   / /\ \ | '__| | | |  _/ _` | |/ _ \/ _` | '_ ` _ \ 
 *  / ____ \| |  | |_| | || (_| | |  __/ (_| | | | | | |
 * /_/    \_\_|   \__,_|_| \__,_|_|\___|\__,_|_| |_| |_|
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the Attribution-ShareAlike 4.0 International Licence as published by
 * the Free Software Foundation, either version 4.0 of the License, or
 * (at your option) any later version.
 *
 * @authors PocketMineTeam and ArufaTeam
 * @arufateam AppleDevelops, Derpific, NFGamerMC, Nought57, RateekMCPE, xZeroMCPE
 * @link arufateam.org
 *
*/

namespace pocketmine\block;

use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\Item;
use pocketmine\item\Tool;
use pocketmine\level\Level;

class RedstoneOre extends Solid{

	protected $id = self::REDSTONE_ORE;

	public function __construct(){

	}

	public function getName() : string{
		return "Redstone Ore";
	}

	public function getHardness() {
		return 3;
	}

	public function onUpdate($type){
		if($type === Level::BLOCK_UPDATE_NORMAL or $type === Level::BLOCK_UPDATE_TOUCH){
			$this->getLevel()->setBlock($this, Block::get(Item::GLOWING_REDSTONE_ORE, $this->meta));

			return Level::BLOCK_UPDATE_WEAK;
		}

		return false;
	}

	public function getToolType(){
		return Tool::TYPE_PICKAXE;
	}

	public function getDrops(Item $item) : array {
		if($item->isPickaxe() >= Tool::TIER_IRON){
			if($item->getEnchantmentLevel(Enchantment::TYPE_MINING_SILK_TOUCH) > 0){
				return [
					[Item::REDSTONE_ORE, 0, 1],
				];
			}else{
				$fortuneL = $item->getEnchantmentLevel(Enchantment::TYPE_MINING_FORTUNE);
				$fortuneL = $fortuneL > 3 ? 3 : $fortuneL;
				return [
					[Item::REDSTONE_DUST, 0, mt_rand(4, 5 + $fortuneL)],
				];
			}
		}else{
			return [];
		}
	}
}
