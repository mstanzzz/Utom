var app = angular.module('closets', []);

app.directive('productList', function() {
	return {
		restrict: 'E',
		scope: {},
		template: "<h1>Tubes:</h1><div class='row'><div class='span3'><form><select ng-options='i.name for i in tubes' name='select' ng-model='item' ng-init='item=tubes[0]'></select></form></div><div class='span5'><h3>{{item.name}}</h3><img src='{{item.image}}'></div></div><h1>Hooks:</h1><h2>Finish</h2><div class='row'><div class='span3'><form><select ng-options='i.finish for i in trevi_hooks' ng-model='selected' ng-init='selected=trevi_hooks[0]'></select></form><h2>Size</h2><form><select ng-options='i.size for i in hook_size' ng-model='size' ng-init='size=hook_size[0]'></select></form><br><h3>size: {{size.size}}</h3></div><div class='span5'><h3>{{selected.name}}</h3>{{selected.desc}}<h4>Brand: {{selected.brand}}</h4><h4>price: <strong>{{selected.price}}</strong></h4><img src='{{selected.image}}' />",

		




		controller: ['$scope', function($scope) {

			$scope.tubes = [
							{ name: 'Oval Oil Rubbed Bronze Tube', 
								image: 'https://www.onlineclosetdesigner.com/saascustuploads/1/cart/small/hafele-oval-tube-oil-rubbed-bronze-1144.jpg' }, 

							{ name: 'Oval Satin Nickel Tube', 
								image: 'http://www.storittek.com/saascustuploads/1/cart/small/hafele-oval-tube-satin-nickel-1145.jpg' }, 

							{ name: 'Round Oil Rubbed Bronze Wardrobe Tube', 
								image: 'http://www.storittek.com/saascustuploads/1/cart/small/hafele-round-wardrobe-tube-oil-rubbed-bronze-1146.jpg' }, 

							{ name: 'Round Satin Nickel Wardrobe Tube', 
								image: 'http://www.storittek.com/saascustuploads/1/cart/small/hafele-round-wardrobe-tube-satin-nickel-1147.jpg' },

							{ name: 'Round Chrome Wardrobe Tube', 
								image: 'http://www.storittek.com/saascustuploads/1/cart/small/hafele-round-wardrobe-tube-chrome-1148.jpg'},

							{ name: 'Round Brass Wardrobe Tube', 
								image: 'http://www.storittek.com/saascustuploads/1/cart/small/hafele-round-wardrobe-tube-brass-1150.jpg'}
							];

			$scope.trevi_hooks = [{ name: 'Trevi MATTE Robe Hook',
									dimensions: '3',
									desc: 'Featuring a MATTE finish and our Patent Pending LockSolid attachment system.',
									finish: 'Matte',
									brand: 'Hardware Resources',
									image: 'https://www.onlineclosetdesigner.com/saascustuploads/1/cart/medium/hardware-resources-trevi-smooth-robe-hook-1485.jpg',
									price: '$3'},

									{ name: 'Trevi SILVER Robe Hook', 
									dimensions: '3',
									desc: 'Featuring a SILVER finish and our Patent Pending LockSolid attachment system.',
									finish: 'Silver',
									brand: 'Hardware Resources',
									image: 'https://www.onlineclosetdesigner.com/saascustuploads/1/cart/medium/hardware-resources-trevi-smooth-robe-hook-1493.jpg',
									price: '$4'}];

			$scope.hook_size = [ {size: 'small'}, {size: 'large'} ];

		}]
	}
});