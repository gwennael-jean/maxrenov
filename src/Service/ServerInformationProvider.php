<?php

namespace App\Service;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;

class ServerInformationProvider
{
    private ?float $diskFreeSpace = null;

    private ?float $diskTotalSpace = null;

    private ?float $percentAvailableSpace = null;

    private ?float $bddUsedSpace = null;

    public function __construct(
        private Connection $connection
    )
    {
    }

    /**
     * @return string
     */
    public function getAvailableSpace(): string
    {
        if (null === $this->diskFreeSpace) {
            $this->diskFreeSpace = disk_free_space('/') ?? 0;
        }

        return $this->getSymbolByQuantity($this->diskFreeSpace);
    }

    /**
     * @return string
     */
    public function getDatabaseUsedSpace(): string
    {
        if (null === $this->bddUsedSpace) {
            $this->bddUsedSpace = 0;

            try {
                $stmt = $this->connection->prepare("SHOW TABLE STATUS");
                $resultSet = $stmt->executeQuery();
                foreach ($resultSet->fetchAllAssociative() as $row) {
                    $this->bddUsedSpace += $row["Data_length"] + $row["Index_length"];
                }
            } catch (Exception $DBALException) {

            }
        }

        return $this->getSymbolByQuantity($this->bddUsedSpace);
    }

    /**
     * @return bool|float|string
     */
    public function getTotalSpace(): string
    {
        if (null === $this->diskTotalSpace) {
            $this->diskTotalSpace = disk_total_space('/');
        }

        return $this->getSymbolByQuantity($this->diskTotalSpace);
    }

    public function getPercentAvailableSpace()
    {
        if (null === $this->percentAvailableSpace) {

            if (null === $this->diskFreeSpace) {
                $this->diskFreeSpace = disk_free_space('/');
            }

            if (null === $this->diskTotalSpace) {
                $this->diskTotalSpace = disk_total_space('/');
            }

            $this->percentAvailableSpace = ($this->diskFreeSpace * 100) / $this->diskTotalSpace;
        }

        return $this->percentAvailableSpace;
    }

    private function getSymbolByQuantity(float $bytes): string
    {
        $symbols = array('Octets', 'Ko', 'Mo', 'Go', 'To', 'Po', 'Eo', 'Zo', 'Yo');
        $exp = floor(log($bytes) / log(1024));
        return number_format($bytes / pow(1024, floor($exp)), 2, ',', ' ') . ' ' . $symbols[$exp];
    }
}