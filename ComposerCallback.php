<?php

namespace basecom\symbox;

class ComposerCallback
{
    public static function install()
    {
        // get the source and target dir
        $sourceDir = \realpath(__DIR__);
        $targetDir = \realpath(\sprintf("%s/../../../", $sourceDir));

        // install symlink
        $cmd = ('win' === \strtolower(\PHP_OS) ? "mklink %s/symbox %s/symbox" : "ln -s %s/symbox %s/symbox");
        \passthru(\sprintf($cmd, $sourceDir, $targetDir));

        // copy the vagrant file
        if(\file_exists($targetDir.'/Vagrantfile')) {
            \copy($targetDir.'/Vagrantfile', $targetDir.'/Vagrantfile.bak');
        }
        \copy($sourceDir.'/Vagrantfile', $targetDir.'/Vagrantfile');
    }

    public static function update()
    {
        self::install();
    }
}
