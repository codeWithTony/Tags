<?php namespace Modules\Tags\Sidebar;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Contracts\Authentication;

class SidebarExtender implements \Maatwebsite\Sidebar\SidebarExtender
{
    /**
     * @var Authentication
     */
    protected $auth;

    /**
     * @param Authentication $auth
     *
     * @internal param Guard $guard
     */
    public function __construct(Authentication $auth)
    {
        $this->auth = $auth;
    }

    /**
     * @param Menu $menu
     *
     * @return Menu
     */
    public function extendWith(Menu $menu)
    {
        $menu->group(trans('core::sidebar.content'), function (Group $group) {
            $group->item(trans('tags::tag.title.tags'), function (Item $item) {
                $item->weight(2);
                $item->icon('fa fa-tags');
                $item->route('admin.tags.tag.index');
                $item->authorize(
                    $this->auth->hasAccess('tags.tags.index')
                );
            });
        });

        return $menu;
    }
}
