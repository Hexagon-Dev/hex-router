Feature: Routing
  User creates routes
  Than he can get access to selected controller and method

  Scenario: Routing
    Given new router
    Given user add /api/posts PostsController@method1
    Given user add /api/posts/{id} PostsController method2
    Given user add /api/posts/{id}/comments PostsController method3
    Given user add /api/posts/{id}/comments/{id} PostsController method3
    When endpoint is /api/posts
    Then matched route is PostsController method1