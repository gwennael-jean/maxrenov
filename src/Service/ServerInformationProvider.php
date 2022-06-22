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
     * @return float
     */
    public function getAvailableSpace(): float
    {
        if (null === $this->diskFreeSpace) {
            $this->diskFreeSpace = disk_free_space('/') ?? 0;
        }

        return $this->diskFreeSpace;
    }

    /**
     * @return float
     */
    public function getDatabaseUsedSpace(): float
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

        return $this->bddUsedSpace;
    }

    /**
     * @return float
     */
    public function getTotalSpace(): float
    {
        if (null === $this->diskTotalSpace) {
            $this->diskTotalSpace = disk_total_space('/') ?? 0;
        }

        return $this->diskTotalSpace;
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
}