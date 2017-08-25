<?php

namespace Bolt\Extension\Blockmurder\CustomUploadPath;

use Silex\Application;
use Bolt\Extension\SimpleExtension;

/**
 * CustomUploadPath extension class.
 *
 * @author blockmurder <info@blockmurder.com>
 */
class CustomUploadPathExtension extends SimpleExtension
{
    /**
     * {@inheritdoc}
     */
    public function boot(Application $app)
    {
        parent::boot($app);

        $app['upload'] = $app->extend(
          'upload',
          function ($handler, $app) {

              $contenttypeslug = $app['request']->get('contenttype');

              $contentTypeConfig = $app['config']->get('contenttypes');

              $uploadDir = $contentTypeConfig[$contenttypeslug]['upload_dir'];

              if($uploadDir != "")
              {
                $folders = explode("/", $uploadDir);
                $prefix = "";
                foreach($folders as &$folder)
                {
                    if($folder != "")
                    {
                        if ('{' == substr($folder, 0, 1) && '}' == substr($folder, -1, 1))
                        {
                            $option = $app['request']->get(substr($folder, 1, strlen($folder) - 2));
                            if($option != "")
                            {
                                $prefix = $prefix.$option."/";
                            }
                        }
                        else
                        {
                            $prefix = $prefix.$folder."/";
                        }
                    }
                }

                $handler->setPrefix($prefix);
            }

            return $handler;
        });
    }
}
