<?php

require './vendor/autoload.php';
use Aws\Glacier\GlacierClient;
use Aws\Result;

const AWS_KEY = '<aws key>';
const AWS_SECRET = '<aws secret>';
const VAULT_NAME = '<vault name>';

class GlacierUtility
{
    /** @var GlacierClient */
    private $client;

    public function __construct()
    {
        // SDKバージョン確認
        // var_dump(\Aws\Sdk::VERSION);
        $this->client = new GlacierClient([
            'credentials' => [
                'key' => AWS_KEY,
                'secret'  => AWS_SECRET,
            ],
            'region' => 'ap-northeast-1',
            'version' => '2012-06-01'
        ]);
    }

    /**
     * @return Result
     */
    function listJobs() {
        return $this->client->listJobs([
//            'completed' => 'false',
            'vaultName' => VAULT_NAME
        ]);
    }

    function describeJob($jobId) {
        return $this->client->describeJob([
            'jobId' => $jobId,
            'vaultName' => VAULT_NAME
        ]);
    }

    function getJobOutput($jobId) {
        return $this->client->getJobOutput([
            'jobId' => $jobId,
//            'range' => 'bytes',
            'vaultName' => VAULT_NAME
        ]);
    }

    function deleteArchive($archiveId) {
        $this->client->deleteArchive([
            'archiveId' => $archiveId,
            'vaultName' => VAULT_NAME
        ]);
    }

    /**
     * @param $type string Should either be 'inventory-retrieval' or
     */
    function createJobInventoryRetrieval()
    {
        $this->client->initiateJob([
            'vaultName' => VAULT_NAME,
            'jobParameters' => [
                'Type' => 'inventory-retrieval'
            ]
        ]);
    }

    function createJobArchiveRetrieval($archiveId)
    {
        $this->client->initiateJob([
            'vaultName' => VAULT_NAME,
            'jobParameters' => [
                'ArchiveId' => $archiveId,
                'Type' => 'archive-retrieval'
            ]
        ]);
    }
}