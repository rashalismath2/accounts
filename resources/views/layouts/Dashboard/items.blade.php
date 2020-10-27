<div id="dashboard-items">

</div>

<script type="text/babel">

    class Dashboard extends React.Component{

        constructor(props){
            super(props)
            this.state={
                widgets:[
                    
                ]
            }
        }

        componentDidMount(){
            axios.get("http://accounts.me/api/widgets")
            .then(res=>{
                this.setState({
                    widgets:res.data
                })
                console.log(this.state.widgets)
            })
            .catch(e=>{
                console.log(e)
            })
        }

        render(){
            
            const items=this.state.widgets.map(wid=>{

                let icon_for_the_item=""
                let dashboard_item_color=""
                var order={ order : wid.sort}
                if (wid.type=="Total Expenses") {
                        icon_for_the_item=<span className="oi oi-cart"></span>
                        dashboard_item_color="dashboard-item-color-red"
                }
                else if(wid.type=="Total Profit"){
                        icon_for_the_item=<span className="oi oi-dollar"></span>
                        dashboard_item_color="dashboard-item-color-green"
                }
                else if(wid.type=="Total Income"){
                        icon_for_the_item=<span className="oi oi-dollar"></span>
                        dashboard_item_color="dashboard-item-color-blue"
                }
  
                if (wid.type=="Total Expenses"
                    || wid.type=="Total Profit" || wid.type=="Total Income") {
                        
                    return(
                            <div style={order}  className={"dashboard-item dashboard-item-total "+ dashboard_item_color +(wid.width==100? " width-full":" ")+(wid.width==20? " width-twenty":" ")+(wid.width==35? " width-thirty":" ") }  key={wid.id}>
                                <div className="dropdown">
                                    <span className="oi oi-menu " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
                                    <div className="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a className="dropdown-item" href="#">Action</a>
                                        <a className="dropdown-item" href="#">Another action</a>
                                        <a className="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                                <div>
                                    <div className="widget-item-header">
                                        <p>{wid.widget_name}</p>
                                        <p>${wid.total}</p>
                                    </div>
                                    <div className="widget-item-icon">
                                        {icon_for_the_item}
                                    </div>    
                                </div>
                            </div>
                        )
                } 
                else {
                            // wil have tables with differenct columns
                            let table=""
                            if (wid.type=="Account Balance") {
                                table=<table className="table">
                                            <thead className="thead-light">
                                                <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">Balance</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {wid.accounts.map(acc=>{
                                                    return(
                                                        <tr key={acc.id}>
                                                            <td>{acc.acc_name}</td>
                                                            <td>${acc.total}</td>
                                                        </tr>
                                                    )
                                                })
                                                }
                                            </tbody>
                                        </table>
                            } 
                            else if(wid.type=="Latest Income"){
                                table=<table className="table">
                                            <thead className="thead-light">
                                                <tr>
                                                <th scope="col">Date</th>
                                                <th scope="col">Payment Method</th>
                                                <th scope="col">Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {wid.incomes.map(inc=>{
                                                    return(
                                                        <tr key={inc.id}>
                                                            <td>{inc.date}</td>
                                                            <td>{inc.payment_method}</td>
                                                            <td>${inc.amount}</td>
                                                        </tr>
                                                    )
                                                })
                                                }
                                            </tbody>
                                        </table>
                            }
                            else if(wid.type=="Latest Expences"){
                                table=<table className="table">
                                            <thead className="thead-light">
                                                <tr>
                                                <th scope="col">Date</th>
                                                <th scope="col">Payment Method</th>
                                                <th scope="col">Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {wid.payments.map(inc=>{
                                                    return(
                                                        <tr key={inc.id}>
                                                            <td>{inc.date}</td>
                                                            <td>{inc.payment_method}</td>
                                                            <td>${inc.amount}</td>
                                                        </tr>
                                                    )
                                                })
                                                }
                                            </tbody>
                                        </table>
                            }

                    return(
                            <div style={order} className={"dashboard-item dashboard-item-details"+ (wid.width==100? "width-full ":" ")+(wid.width==20? "width-twenty ":" ")+(wid.width==35? "width-thirty ":" ") }  key={wid.id}>
                                <div  className="dashboard-item-details-header">
                                    <div className="dropdown">
                                        <span className="oi oi-menu " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
                                        <div className="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a className="dropdown-item" href="#">Action</a>
                                            <a className="dropdown-item" href="#">Another action</a>
                                            <a className="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                    <div>
                                        <p className="dashboard-item-details-name">{wid.widget_name}</p>
                                    </div>
                                </div>
                                <div>
                                    {table}
                                </div>
                            </div>
                        )

                }
                
            })

            return(
                <div id="dashboard-items-cont">
                    {items}
                </div>
            )
        }
    }

    ReactDOM.render(
      <Dashboard />,
      document.getElementById('dashboard-items')
    );

  </script>