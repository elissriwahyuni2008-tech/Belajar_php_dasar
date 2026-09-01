<?php
namespace App\Warehouse;

interface Managable {
    public function calculateAssetValue(): float;
}

trait LogTrait {
    public function getLogInfo(): string {
        return "Log Sistem: Barang tercatat dalam database inventaris utama.";
    }
}

abstract class Item implements Managable {
    use LogTrait;

    protected string $name;
    protected string $category;
    private float $price;
    protected int $stock;

    public function __construct(string $name, string $category, float $price, int $stock) {
        $this->name = $name;
        $this->category = $category;
        $this->price = $price;
        $this->stock = $stock;
    }

    public function getName(): string { return $this->name; }
    public function getPrice(): float { return $this->price; }
    public function getStock(): int { return $this->stock; }
    public function getCategory(): string { return $this->category; }

    public function updateData(string $category, float $price, int $stock) {
        $this->category = $category;
        $this->price = $price;
        $this->stock = $stock;
    }

    abstract public function getItemDetails(): string;
    abstract public function getDescription(): string;
}

class HardwareItem extends Item {
    private string $unit;

    public function __construct(string $name, string $category, float $price, int $stock, string $unit) {
        parent::__construct($name, $category, $price, $stock);
        $this->unit = $unit;
    }

    public function getUnit(): string { return $this->unit; }

    public function updateHardwareData(string $category, float $price, int $stock, string $unit) {
        $this->updateData($category, $price, $stock);
        $this->unit = $unit;
    }

    public function getItemDetails(): string { return $this->name; }
    public function getDescription(): string { return "Kategori: " . $this->category; }
    public function calculateAssetValue(): float { return $this->getPrice() * $this->getStock(); }
}