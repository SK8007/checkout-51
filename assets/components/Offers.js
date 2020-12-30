import React from "react";
import axios from "axios";
import MaterialTable from "material-table";

const Offers = () => {
  const [isLoading, setIsLoading] = React.useState(false);
  const [data, setData] = React.useState([]);
  React.useEffect(async () => {
    setIsLoading(true);
    try {
      const apiData = await axios("api/offers");
      console.log(apiData);
      const {
        data: { offers },
      } = apiData;
      const formattedOffers = offers.map((offer) => ({
        ...offer,
        image: <img src={offer.imageUrl} alt={offer.name} />,
      }));
      setData(formattedOffers);
    } catch (error) {
      console.log(error);
    }
    setIsLoading(false);
  }, []);

  const columns = [
    { title: "ID", field: "offerId" },
    { title: "Name", field: "name" },
    { title: "Image", field: "image", sorting: false },
    {
      title: "Cash Back",
      field: "cashBack",
      type: "currency",
      currencySetting: {
        locale: "en-US",
        currencyCode: "USD",
        minimumFractionDigits: 2,
        maximumFractionDigits: 2,
      },
    },
  ];

  return (
    <div className="offers">
      <MaterialTable
        title="Offers"
        columns={columns}
        data={data}
        isLoading={isLoading}
        options={{
          pageSize: 25,
          pageSizeOptions: [10, 25, 50, 100],
        }}
      />
    </div>
  );
};

export default Offers;
