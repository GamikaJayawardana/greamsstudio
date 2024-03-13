<?php
/**
 * Api routes
 */

if (!defined('ABSPATH')) {
    die('No direct access.');
}

use Extendify\ApiRouter;
use Extendify\Library\Controllers\SiteController;

use Extendify\Launch\Controllers\DataController;
use Extendify\Launch\Controllers\WPController;
use Extendify\Launch\Controllers\UserSelectionController;

use Extendify\Assist\Controllers\AssistDataController;
use Extendify\Assist\Controllers\GlobalsController;
use Extendify\Assist\Controllers\TasksController;
use Extendify\Assist\Controllers\TourController;
use Extendify\Assist\Controllers\RouterController;
use Extendify\Assist\Controllers\UserSelectionController as AssistSelectionController;
use Extendify\Assist\Controllers\WPController as AssistWPController;
use Extendify\Assist\Controllers\QuickLinksController;
use Extendify\Assist\Controllers\RecommendationsController;
use Extendify\Assist\Controllers\SupportArticlesController;
use Extendify\Assist\Controllers\RecommendationsBannerController;

use Extendify\Chat\Controllers\ChatController;

use Extendify\Draft\Controllers\DraftController;
use Extendify\Draft\Controllers\UserSettingsController;

\add_action(
    'rest_api_init',
    function () {
        // Library.
        ApiRouter::get('/library/settings', [SiteController::class, 'get']);
        ApiRouter::post('/library/settings', [SiteController::class, 'store']);
        ApiRouter::post('/library/settings/single', [SiteController::class, 'single']);
        // TODO: Remove this after a few months.
        ApiRouter::post('/library/settings/add-utils-to-global-styles', [SiteController::class, 'addUtilsToGlobalStyles']);

        // Launch.
        ApiRouter::post('/launch/options', [WPController::class, 'updateOption']);
        ApiRouter::get('/launch/options', [WPController::class, 'getOption']);
        ApiRouter::get('/launch/active-plugins', [WPController::class, 'getActivePlugins']);
        ApiRouter::get('/launch/goals', [DataController::class, 'getGoals']);
        ApiRouter::get('/launch/suggested-plugins', [DataController::class, 'getSuggestedPlugins']);
        ApiRouter::get('/launch/ping', [DataController::class, 'ping']);
        ApiRouter::get('/launch/user-selection-data', [UserSelectionController::class, 'get']);
        ApiRouter::post('/launch/user-selection-data', [UserSelectionController::class, 'store']);
        ApiRouter::get('/launch/prefetch-assist-data', [WPController::class, 'prefetchAssistData']);

        // Assist.
        ApiRouter::post('/assist/options', [AssistWPController::class, 'updateOption']);
        ApiRouter::get('/assist/options', [AssistWPController::class, 'getOption']);
        ApiRouter::get('/assist/launch-pages', [AssistDataController::class, 'getLaunchPages']);
        ApiRouter::get('/assist/tasks', [TasksController::class, 'fetchTasks']);
        ApiRouter::get('/assist/task-data', [TasksController::class, 'get']);
        ApiRouter::post('/assist/task-data', [TasksController::class, 'store']);
        ApiRouter::get('/assist/tours', [TourController::class, 'fetchTours']);
        ApiRouter::get('/assist/tour-data', [TourController::class, 'get']);
        ApiRouter::post('/assist/tour-data', [TourController::class, 'store']);
        ApiRouter::post('/assist/router-data', [RouterController::class, 'store']);
        ApiRouter::get('/assist/router-data', [RouterController::class, 'get']);
        ApiRouter::get('/assist/global-data', [GlobalsController::class, 'get']);
        ApiRouter::post('/assist/global-data', [GlobalsController::class, 'store']);
        ApiRouter::get('/assist/user-selection-data', [AssistSelectionController::class, 'get']);
        ApiRouter::post('/assist/user-selection-data', [AssistSelectionController::class, 'store']);
        ApiRouter::get('/assist/active-plugins', [AssistWPController::class, 'getActivePlugins']);
        ApiRouter::get('/assist/tasks/dependency-completed', [TasksController::class, 'dependencyCompleted']);
        ApiRouter::get('/assist/quicklinks', [QuickLinksController::class, 'fetchQuickLinks']);
        ApiRouter::get('/assist/recommendations', [RecommendationsController::class, 'fetchRecommendations']);
        ApiRouter::get('/assist/recommendation-data', [RecommendationsController::class, 'get']);
        ApiRouter::post('/assist/recommendation-data', [RecommendationsController::class, 'store']);
        ApiRouter::get('/assist/support-articles', [SupportArticlesController::class, 'articles']);
        ApiRouter::get('/assist/support-article-categories', [SupportArticlesController::class, 'categories']);
        ApiRouter::get('/assist/support-article', [SupportArticlesController::class, 'article']);
        ApiRouter::get('/assist/support-articles-data', [SupportArticlesController::class, 'get']);
        ApiRouter::post('/assist/support-articles-data', [SupportArticlesController::class, 'store']);
        ApiRouter::get('/assist/get-redirect', [SupportArticlesController::class, 'getRedirect']);
        ApiRouter::get('/assist/recommendations-banner', [RecommendationsBannerController::class, 'get']);

        // Chat.
        ApiRouter::get('/chat/options', [ChatController::class, 'getOptions']);
        ApiRouter::post('/chat/options', [ChatController::class, 'updateOptions']);
        ApiRouter::post('/chat/update-user-meta/', [ChatController::class, 'updateUserMeta']);

        // Draft.
        ApiRouter::post('/draft/update-user-meta', [DraftController::class, 'updateUserMeta']);
        ApiRouter::get('/draft/user-settings', [UserSettingsController::class, 'get']);
        ApiRouter::post('/draft/user-settings', [UserSettingsController::class, 'store']);
    }
);
