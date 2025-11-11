
export default{
    name:'commonFn',
    methods:{
        checkRoleAction (ActionCode=''){         
            let username = this.$store.getters.user.name
            let listAction = this.$store.getters.user['ListAction'] ? this.$store.getters.user['ListAction'][0]: []           
            let role = this.$store.getters.user.roles[0]            
            return listAction.includes(ActionCode)
        }
    }

}