angular.module("app",["AppServices"]).constant("API_URL","/shop").config(["$httpProvider",function(t){t.defaults.headers.common["X-Requested-With"]="XMLHttpRequest"}]).controller("ShopBusinessPartnersController",["$http","SQLSTATEFactory","API_URL","GlobalFactory",function(t,o,e,a){var n=this;n.search=null,n.category="All",n.sortby="default",n.mscproducts=[],n.navlinks={},n.meta={},n.totalamount=0,n.totalnetamount=0,n.LoadCategories=function(){t.get("/shop-categories?v="+Math.random(),{}).then(function(t){var o=t.data;n.msccategories=o,hideCustomizeLoading()},function(t){swal("Opps!","Something went wrong!","error"),console.log(t)})},n.LoadProducts=function(o){o=o||"/shop-search?v="+Math.random(),n.mscproducts=[],t.post(o,{shoptype:"businesspartners",search:n.search,category:n.category,sortby:n.sortby}).then(function(t){var o=t.data;n.navlinks=o.links,n.meta=o.meta,n.mscproducts=o.data,n.CalculateTotal(),hideCustomizeLoading()},function(t){swal("Opps!","Something went wrong!","error"),console.log(t),hideCustomizeLoading()})},n.UpdateCart=function(t,o){o.selectedqty=isNaN(o.selectedqty)||null==o.selectedqty||""==o.selectedqty?0:o.selectedqty,"plus"==t?o.selectedqty++:"minus"==t&&o.selectedqty--,o.selectedqty<=0&&(o.selectedqty=0),n.CalculateTotal()},n.AddToCart=function(t){if(t.selectedqty>0){var o={productid:t.productid,qty:t.selectedqty};document.cookie="yeslifecart_"+o.productid+"=0; path=/",addCartCookie(o)}else removeCartCookie(t.productid)},n.CalculateTotal=function(){n.totalamount=0,n.totalcoupondiscount=0,n.totaltax=0,n.totalshipcost=0,n.totalnetamount=0,n.mscproducts.forEach(function(t,o){t.totalamount=parseFloat(t.selectedqty)*parseFloat(t.cartdiscountedprice),t.taxamount=0,t.shipamount=0,t.netamount=0,t.netamount=parseFloat(t.totalamount),n.totalamount+=parseFloat(t.totalamount),n.totalnetamount+=parseFloat(t.netamount),t.totalamount=parseFloat(t.totalamount).toFixed(2),t.netamount=parseFloat(t.netamount).toFixed(2)}),n.totalamount=parseFloat(n.totalamount).toFixed(2),n.totalnetamount=parseFloat(n.totalnetamount).toFixed(2)},n.SearchProducts=function(){showCustomizeLoadingNoIcon(),n.mscproducts=[],n.LoadProducts()},showCustomizeLoadingNoIcon(),setTimeout(function(){n.LoadProducts(),setTimeout(function(){n.LoadCategories()},500)},500)}]);