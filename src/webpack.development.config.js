const path = require('path');
const commonWebpack = require('./webpack.common.config');
const mergeWebpack = require('webpack-merge');
const HtmlWebpackPlugin = require('html-webpack-plugin');


module.exports = mergeWebpack(commonWebpack, {
	output: {
		filename: "[name].js",
		path: path.resolve(__dirname, './dist'),
		publicPath: ""
	},
	devServer: {
		index: 'index.html',
		port: 9000,
		contentBase: path.join(__dirname, 'src'),
		watchContentBase: true,
		disableHostCheck: true
	},
	mode: "development",
	module: {
		rules: [
			{
				test: /\.scss$/,
				use: [
					'style-loader',
					'css-loader',
					'sass-loader'
				]
			}
		]
	},
	plugins: [
		new HtmlWebpackPlugin({
			title: 'index',
			filename: "index.html",
			template: "./src/index.html",
			meta: {
				description: 'home description'
			},
			chunks: ['app'],
			minify: false
		}),
		new HtmlWebpackPlugin({
			title: 'product detail view',
			filename: "product-detail-view.html",
			template: "./src/product-detail-view.html",
			meta: {
				description: 'product detail view'
			},
			chunks: ['app'],
			minify: false
		}),
		new HtmlWebpackPlugin({
			title: 'about-us',
			filename: "about-us.html",
			template: "./src/about-us.html",
			meta: {
				description: 'about-us'
			},
			chunks: ['app'],
			minify: false
		}),
		new HtmlWebpackPlugin({
			title: 'services',
			filename: "services.html",
			template: "./src/services.html",
			meta: {
				description: 'services'
			},
			chunks: ['app'],
			minify: false
		}),
		new HtmlWebpackPlugin({
			title: 'support',
			filename: "support.html",
			template: "./src/support.html",
			meta: {
				description: 'support'
			},
			chunks: ['app'],
			minify: false
		}),
		new HtmlWebpackPlugin({
			title: 'solution-detail-view',
			filename: "solution-detail-view.html",
			template: "./src/solution-detail-view.html",
			meta: {
				description: 'solution detail view'
			},
			chunks: ['app'],
			minify: false
		}),
		new HtmlWebpackPlugin({
			title: 'free-in-home-consults',
			filename: "free-in-home-consults.html",
			template: "./src/free-in-home-consults.html",
			meta: {
				description: 'free in home consults'
			},
			chunks: ['app'],
			minify: false
		}),
		new HtmlWebpackPlugin({
			title: 'browse-by-room',
			filename: "browse-by-room.html",
			template: "./src/browse-by-room.html",
			meta: {
				description: 'browse by room'
			},
			chunks: ['app'],
			minify: false
		}),
		new HtmlWebpackPlugin({
			title: 'fax-a-design-plan',
			filename: "fax-a-design-plan.html",
			template: "./src/fax-a-design-plan.html",
			meta: {
				description: 'fax a design plan'
			},
			chunks: ['app'],
			minify: false
		}),
		new HtmlWebpackPlugin({
			title: 'diy-instructions',
			filename: "diy-instructions.html",
			template: "./src/diy-instructions.html",
			meta: {
				description: 'DIY instructions'
			},
			chunks: ['app'],
			minify: false
		}),
		new HtmlWebpackPlugin({
			title: 'category-list-view',
			filename: "category-list-view.html",
			template: "./src/category-list-view.html",
			meta: {
				description: 'category list view'
			},
			chunks: ['app'],
			minify: false
		}),
		new HtmlWebpackPlugin({
			title: 'specifications',
			filename: "specifications.html",
			template: "./src/specifications.html",
			meta: {
				description: 'specifications'
			},
			chunks: ['app'],
			minify: false
		}),
		new HtmlWebpackPlugin({
			title: 'specifications-details',
			filename: "specifications-details.html",
			template: "./src/specifications-details.html",
			meta: {
				description: 'specifications details'
			},
			chunks: ['app'],
			minify: false
		}),
		new HtmlWebpackPlugin({
			title: 'shopping-cart',
			filename: "shopping-cart.html",
			template: "./src/shopping-cart.html",
			meta: {
				description: 'shopping-cart'
			},
			chunks: ['app'],
			minify: false
		}),
		new HtmlWebpackPlugin({
			title: 'login',
			filename: "login.html",
			template: "./src/login.html",
			meta: {
				description: 'login'
			},
			chunks: ['app'],
			minify: false
		}),
		new HtmlWebpackPlugin({
			title: 'checkout',
			filename: "checkout.html",
			template: "./src/checkout.html",
			meta: {
				description: 'checkout'
			},
			chunks: ['app'],
			minify: false
		}),
		new HtmlWebpackPlugin({
			title: 'order',
			filename: "order.html",
			template: "./src/order.html",
			meta: {
				description: 'order'
			},
			chunks: ['app'],
			minify: false
		}),
		new HtmlWebpackPlugin({
			title: 'Organizer landing page',
			filename: "organizer-landing-page.html",
			template: "./src/organizer-landing-page.html",
			meta: {
				description: 'organizer-landing-page'
			},
			chunks: ['app'],
			minify: false
		}),
		new HtmlWebpackPlugin({
			title: 'showroom detail view page',
			filename: "showroom-detail-view-categories.html",
			template: "./src/showroom-detail-view-categories.html",
			meta: {
				description: 'showroom-detail-view-categories'
			},
			chunks: ['app'],
			minify: false
		}),
		new HtmlWebpackPlugin({
			title: 'showroom detail view page',
			filename: "showroom-detail-view-category.html",
			template: "./src/showroom-detail-view-category.html",
			meta: {
				description: 'showroom-detail-view-category'
			},
			chunks: ['app'],
			minify: false
		}),
		new HtmlWebpackPlugin({
			title: 'Account',
			filename: "account.html",
			template: "./src/account.html",
			meta: {
				description: 'account'
			},
			chunks: ['app'],
			minify: false
		}),
		new HtmlWebpackPlugin({
			title: 'Account settings',
			filename: "account-settings.html",
			template: "./src/account-settings.html",
			meta: {
				description: 'account settings'
			},
			chunks: ['app'],
			minify: false
		}),
		new HtmlWebpackPlugin({
			title: 'Account my orders',
			filename: "account-orders.html",
			template: "./src/account-orders.html",
			meta: {
				description: 'account my orders'
			},
			chunks: ['app'],
			minify: false
		}),
		new HtmlWebpackPlugin({
			title: 'Account payment settings',
			filename: "account-payments.html",
			template: "./src/account-payments.html",
			meta: {
				description: 'Account payment settings'
			},
			chunks: ['app'],
			minify: false
		}),
		new HtmlWebpackPlugin({
			title: 'Account idea folder',
			filename: "account-idea-folder.html",
			template: "./src/account-idea-folder.html",
			meta: {
				description: 'Account idea folder'
			},
			chunks: ['app'],
			minify: false
		}),
		new HtmlWebpackPlugin({
			title: 'Account idea folder details',
			filename: "account-idea-folder-details.html",
			template: "./src/account-idea-folder-details.html",
			meta: {
				description: 'Account idea folder details'
			},
			chunks: ['app'],
			minify: false
		}),
		new HtmlWebpackPlugin({
			title: 'We design',
			filename: "we-design.html",
			template: "./src/we-design.html",
			meta: {
				description: 'We design'
			},
			chunks: ['app'],
			minify: false
		}),
		new HtmlWebpackPlugin({
			title: 'Account idea folder empty',
			filename: "account-idea-folder-empty.html",
			template: "./src/account-idea-folder-empty.html",
			meta: {
				description: 'Account idea folder empty'
			},
			chunks: ['app'],
			minify: false
		}),
		new HtmlWebpackPlugin({
			title: 'Showroom detail view product',
			filename: "showroom-detail-view-product.html",
			template: "./src/showroom-detail-view-product.html",
			meta: {
				description: 'Showroom detail view product'
			},
			chunks: ['app'],
			minify: false
		}),
		new HtmlWebpackPlugin({
			title: 'Video library main page',
			filename: "video-library.html",
			template: "./src/video-library.html",
			meta: {
				description: 'Video library main page'
			},
			chunks: ['app'],
			minify: false
		}),
		new HtmlWebpackPlugin({
			title: 'Video library detail page',
			filename: "video-library-detail.html",
			template: "./src/video-library-detail.html",
			meta: {
				description: 'Video library detail page'
			},
			chunks: ['app'],
			minify: false
		}),
		new HtmlWebpackPlugin({
			title: 'Comparison page',
			filename: "comparison.html",
			template: "./src/comparison.html",
			meta: {
				description: 'Comparison page'
			},
			chunks: ['app'],
			minify: false
		}),
		new HtmlWebpackPlugin({
			title: 'Features Detail page',
			filename: "features-detail.html",
			template: "./src/features-detail.html",
			meta: {
				description: 'Features Detail page'
			},
			chunks: ['app'],
			minify: false
		}),
		new HtmlWebpackPlugin({
			title: 'Features Category',
			filename: "features-category.html",
			template: "./src/features-category.html",
			meta: {
				description: 'Features Category page'
			},
			chunks: ['app'],
			minify: false
		}),
		new HtmlWebpackPlugin({
			title: 'Accessory Category',
			filename: "accessory-category.html",
			template: "./src/accessory-category.html",
			meta: {
				description: 'Accessory Category page'
			},
			chunks: ['app'],
			minify: false
		}),
		new HtmlWebpackPlugin({
			title: 'We design survey',
			filename: "we-design-survey.html",
			template: "./src/we-design-survey.html",
			meta: {
				description: 'We design survey'
			},
			chunks: ['app'],
			minify: false
		}),
		new HtmlWebpackPlugin({
			title: 'Accessories page',
			filename: "accessories.html",
			template: "./src/accessories.html",
			meta: {
				description: 'Accessories page'
			},
			chunks: ['app'],
			minify: false
		})
	]
})
