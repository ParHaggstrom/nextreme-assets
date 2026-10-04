app.controller("bodyCtrl", [
  "$scope",
  "$backend",
  "$search",
  "$debug",
  function ($scope, $backend, $search, $debug) {
    $scope = $scope.$parent; // Lets make sure we work in the right $scope
    $debug({ bodyCtrl: $scope });

    /* Vars */
    $scope.instance = $scope.instance || {};
    $scope.instance.showSearch = true;

    angular.element("body").find(".toolbar wa-button").attr("pill", true);
  },
]);
