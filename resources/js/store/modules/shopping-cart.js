import product from "../../api/admin/product";
const state = {
    cart: [],
    toast: {
        text: "",
        show: false
    }
};
const mutations = {
    setUpProducts: (state, productsPayload) => {
        //sets the state's  products property to the products array recieved as payload
        state.products = productsPayload;
    },
    addToCart: (state, product) => {
        // //find the product in the cart list
        let cartProduct = state.cart.find((productel) => productel.id === product.id);

        if (cartProduct) {
            let findIndexOption = state.cart.findIndex((productel) => (productel.id === product.id && productel['payment']['id']==product['payment']['id']&&productel['payment']['id_size']==product['payment']['id_size']))
            if(findIndexOption !=-1){
                state.cart[findIndexOption]['payment']['total']+=product['payment']['total']
            }else{
                state.cart.push({
                    // product newly added to cart
                    ...product,
                });
            }

        } else {
            state.cart.push({
                // product newly added to cart
                ...product,
            });
        }

    },
    pushItem(state, product){
        // //find the product in the cart list
        let cartProduct = state.cart.find((productel) => productel.id === product.id);
        if (cartProduct) {
            let findIndexOption = state.cart.findIndex((productel) => (productel.id === product.id && productel['payment']['id']==product['payment']['id']))
            if(findIndexOption !=-1){
                state.cart[findIndexOption]['payment']['total']+=1
            }
        }
    },
    removeItem(state, product){
        let cartProduct = state.cart.find((productel) => productel.id === product.id);
        if (cartProduct) {
            let findIndexOption = state.cart.findIndex((productel) => (productel.id === product.id && productel['payment']['id']==product['payment']['id']))
            if(findIndexOption !=-1){
                state.cart[findIndexOption]['payment']['total']-=1
            }
        }
    },

    removeAllCart:(state) => {
        state.cart=[]
    },

    removeFromCart: (state, productId) => {
        // //find the product in the products list
        // let product = state.products.find((product) => product.id === productId);
        // //find the product in the cart list
        // let cartProduct = state.cart.find((product) => product.id === productId);
        //
        // cartProduct.quantity--;
        // //Add back the quantity in products list by 1
        // product.quantity++;
    },
    deleteFromCart: (state, productId) => {
        //find the product index in the cart list
        let cartProductIndex = state.cart.findIndex((product) => product.id === productId);
        // remove the product from the cart
        state.cart.splice(cartProductIndex, 1);
    },
    showToast: (state, toastText) => {
        state.toast.show = true;
        state.toast.text = toastText;
    },
    hideToast: (state) => {
        state.toast.show = false;
        state.toast.text = "";
    }
};

const actions = {
    fetchProducts: ({ commit }) => {
        //simulating a fake ajax request to fetch products from database
        ProductResource.getProduct().then((products) => {
            //passing the products recieved from response as a payload to the mutation
            commit("setUpProducts", products);
            commit("showToast", "products loaded");
        });
    },
    addToCart: ({ commit }, productId) => {
        // myApi.products("add", productId).then((productId) => {
            commit("addToCart", productId);
            commit("showToast", "added to cart");
        // });
    },
    pushItem: ({ commit }, productId) => {
            commit("pushItem", productId);
    },
    removeItem: ({ commit }, productId) => {
            commit("removeItem", productId);
    },

    removeAllCart: ({ commit }, productId) => {
        commit("removeAllCart");
    },



    removeFromCart: ({ commit }, productId) => {
        // myApi.products("remove", productId).then((productId) => {
            commit("removeFromCart", productId);
            commit("showToast", "removed from cart");
        // });
    },
    deleteFromCart: ({ commit }, productId) => {
        // myApi.products("delete", productId).then((productId) => {
            commit("deleteFromCart", productId);
            commit("showToast", "deleted from cart");
        // });

    }
};

export default {
    namespaced: true,
    state,
    mutations,
    actions,
};
