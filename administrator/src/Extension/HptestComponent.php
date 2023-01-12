<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Hptest
 * @author     Giorgio <gacompa@gmail.com>
 * @copyright  2022 Giorgio
 * @license    GNU General Public License versione 2 o successiva; vedi LICENSE.txt
 */

namespace Hptest\Component\Hptest\Administrator\Extension;

defined('JPATH_PLATFORM') or die;

use Hptest\Component\Hptest\Administrator\Service\Html\HPTEST;
use Joomla\CMS\Application\SiteApplication;
use Joomla\CMS\Association\AssociationServiceInterface;
use Joomla\CMS\Association\AssociationServiceTrait;
use Joomla\CMS\Categories\CategoryServiceTrait;
use Joomla\CMS\Component\Router\RouterServiceInterface;
use Joomla\CMS\Component\Router\RouterServiceTrait;
use Joomla\CMS\Extension\BootableExtensionInterface;
use Joomla\CMS\Extension\MVCComponent;
use Joomla\CMS\HTML\HTMLRegistryAwareTrait;
use Joomla\CMS\Tag\TagServiceTrait;
use Psr\Container\ContainerInterface;

/**
 * Component class for Hptest
 *
 * @since  1.0.0
 */
class HptestComponent extends MVCComponent implements RouterServiceInterface, BootableExtensionInterface
{
	use AssociationServiceTrait;
	use RouterServiceTrait;
	use HTMLRegistryAwareTrait;
	use CategoryServiceTrait, TagServiceTrait {
		CategoryServiceTrait::getTableNameForSection insteadof TagServiceTrait;
		CategoryServiceTrait::getStateColumnForSection insteadof TagServiceTrait;
	}

	/** @inheritdoc  */
	public function boot(ContainerInterface $container)
	{
		$db = $container->get('DatabaseDriver');
		$this->getRegistry()->register('hptest', new HPTEST($db));
	}

}