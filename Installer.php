<?php

namespace akiraz2\blog;

use Composer\Package\PackageInterface;
use Composer\Installer\LibraryInstaller;
use Composer\Repository\InstalledRepositoryInterface;
use Composer\Script\CommandEvent;
use Composer\Script\Event;
use Composer\Util\Filesystem;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class Installer extends LibraryInstaller
{
    public static function postInstall($event)
    {
        $dirPath= \Yii::getAlias('@app/media/imagemanager');
        try {
            if (!is_dir(dirname($dirPath))) {
                mkdir(dirname($dirPath), 0666, true);
            }
        } catch (\Exception $e) {
            echo $e->getMessage() . "\n";
        }
    }
}
