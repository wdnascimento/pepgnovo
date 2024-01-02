<template>
    <div id="app" class="container">
        <div class="row text-center py-2">
            <h1 class="w-100">Marcar Atendimentos</h1>    
        </div>
        <div class="row">
            <div class="col-12">
                <b-card class="h-100" >
                    <b-form @submit="onSubmit" @reset="onReset" >
                        <b-form-group
                            id="input-group-1"
                            label="Digite o PRONTUÁRIO ou KIT:"
                            label-for="input-1"
                            description=""
                            label-class="text-center"
                            >
                            <b-form-input
                                id="input-1"
                                name="input-1"
                                v-model="form.prontuario"
                                class="text-center h1"
                                style="font-size: 2em"
                                placeholder="PRONT. OU KIT"
                                >
                            </b-form-input>
                        </b-form-group>
                    </b-form>
                </b-card>
            </div>
            <div class="col-12">
                <b-card v-if="preso.show">
                    <div class="row px-2">
                        <div class="col-4 center">
                            <b-avatar v-bind:src="preso.foto" class="justify-content-center" size="6rem"></b-avatar>
                        </div>
                        <div class="col-8">
                            <p class="h2"  >Prontuário: <strong>{{ preso.prontuario }}</strong> </p>
                            <p class="h2" >Nome: {{ preso.nome }}</p>
                        </div>
                    </div>
                </b-card>
            </div>
        </div>
        <div class="row">  
            <div v-if="(!preso.show)" class="col-12">
                <b-alert  show variant="primary" class="text-center">Nenhum preso selecionado.</b-alert>
            </div>   
            <div v-if="preso.show" class="col-6 pt-3">
                <router-link to="/marcaratendimento"  class="btn btn-success w-100 p-3 h2" v-bind:url="this.url" >Marcar Atendimentos</router-link>
            </div>
            <div v-if="preso.show" class="col-6 pt-3">
                <router-link to="/buscaratendimentos"  class="btn btn-primary w-100 p-3 h2" v-bind:url="this.url" >Resposta de Atendimentos</router-link>
            </div>
        </div>
        <router-view v-if="preso.show" :preso="this.preso" v-bind:url="this.url"></router-view>
        <div class="row" >  
            <div  class="col-12">
                 <b-button  variant="danger" @click="limparCampos" class="w-100 p-3 h2">SAIR</b-button>
            </div>   
        </div>
    </div>
</template>
<style>
    .setor:active{
        background-color: #000;
    }
</style>
<script>
    export default {
        props: {
            url : String
        },
        
        data() {
            return {
                param : {
                    limite_atendimento : 0
                },
                form: {
                    prontuario: '',
                },
                preso: {
                    id : null,
                    prontuario : null,
                    kit : null,
                    nome: '',
                    foto : '',
                    show: false ,
                },
                active : ''
            }
        },
        created(){
            
            axios.get(this.url+"/api/parametro/limite_atendimento")
            .then(res => {
                if(res.data){
                    this.limite_atendimento = res.data.valor;
                }else{
                        this.$toasted.show("Parametro não encontrado.", { 
                        theme: "toasted-primary", 
                        position: "top-right", 
                        duration : 2000
                    });
                }
                
            })
            .catch(function(err){
                this.$toasted.show("Erro ao Carregar Parametros!!", { 
                    theme: "toasted-primary", 
                    position: "top-right", 
                    duration : 2000
                });
            })                    
        },
        methods: {
            // -----------------------------------
            // EVENTOS
            // -----------------------------------
            
            marcarAtendimentos(){
                this.$router.push({
                    path: '/marcaratendimento'
                });
            },

            buscarAtendimentos(){
                this.$router.push({
                    path: '/buscaratendimentos:url',
                    params : {
                        'url' : 'este'
                    }
                });
            },

            limparCampos(){
                this.preso.id= null;
                this.preso.prontuario= null;
                this.form.prontuario = "";
                this.preso.kit= null;
                this.preso.nome= '';
                this.preso.foto= '';
                this.preso.show = false; 
            },

            initRoute() {
                this.$router.push('/');
            },

            onReset(event) {
                event.preventDefault()
                // Reset our form values
                this.form.prontuario = '';
                this.preso.show= false;
            },
            
            // -----------------------------------
            // ACESSO API
            // -----------------------------------
           
            onSubmit(event) {
                this.initRoute();
                event.preventDefault();
                axios.get(this.url+"/api/preso/"+this.form.prontuario)
                .then(res => {
                    if(res.data.length){
                        this.preso.id= res.data[0].id;
                        this.preso.kit= res.data[0].kit;
                        this.preso.prontuario= res.data[0].prontuario;
                        this.preso.nome= res.data[0].nome;
                        this.preso.foto= 'http://www.spr.depen.pr.gov.br/centralvagas/exibirFoto.jpg?numProntuario='+res.data[0].prontuario+'&idImagem=1';
                        this.preso.show = true; 
                    }else{
                         this.$toasted.show("Prontuário ou KIT INVÁLIDO.", { 
                            theme: "toasted-primary", 
                            position: "top-right", 
                            duration : 2000
                        });
                        this.limparCampos();                       
                   }
                })
                .catch(function(err){
                    this.$toasted.show("Erro!!"+err, { 
                        theme: "toasted-primary", 
                        position: "top-right", 
                        duration : 2000
                    });
                })
            }
        }
    }
</script>