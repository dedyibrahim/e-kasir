class V_produk extends React.Component{
    constructor(props){
        super(props);
        this.state ={
            error:null, 
            isLoaded:false,
        };
       }
    componentDidMount(){
        fetch("Data_produk")
                .then(res=>res.json())
                .then((result)=>{
                    
                    this.setState({
                        isLoaded:true,
                        items:result
                        
                    });
                },
                
                (error)=>{
                    this.setState({
                       isLoaded:true,
                       error
                        
                    });
                    
                }
                        
                )
    }
        render(){
            
            const {error,isLoaded,items}
            = this.state;
            if (error){
                return <div> Error: {error.message} </div> ;
                
                
                
            }else if (!isLoaded) {
                return <div>Loading...</div>;


                
            }else{
                
                return (
                        <ul>
                        {items.map(item => 
                        (
                        <li key={item.nama_produk} >
                
                                {item.harga_produk}
                                {item.nama_produk} 
                         </li>        
                        ))}
                    </ul>              
                        );
            }   
    
        }
        
    }
    
    
ReactDOM.render(
        <V_produk />,
        document.getElementById("produk")
        );

