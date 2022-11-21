<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Announcement;
use App\Models\Attachment;
use App\Models\Group;
use App\Models\Event;
use App\Models\Image;
use App\Models\Tag;
use App\Models\User;
use App\Policies\AnnouncementPolicy;
use App\Policies\AttachmentPolicy;
use App\Policies\EventPolicy;
use App\Policies\GroupPolicy;
use App\Policies\ImagePolicy;
use App\Policies\TagPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Announcement::class => AnnouncementPolicy::class,
        Attachment::class => AttachmentPolicy::class,
        Event::class => EventPolicy::class,
        Group::class => GroupPolicy::class,
        Image::class => ImagePolicy::class,
        Tag::class => TagPolicy::class,
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
