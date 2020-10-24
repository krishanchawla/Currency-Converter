package com.project.currencyconverter.service;

import com.fasterxml.jackson.core.JsonProcessingException;
import com.fasterxml.jackson.databind.ObjectMapper;
import org.springframework.stereotype.Service;
import org.springframework.web.client.RestTemplate;

import java.text.DecimalFormat;
import java.util.*;

@Service
public class CurrencyConverterService {

    public HashMap<String, String> getAvailableCurrencyCodes() throws JsonProcessingException {
        final String uri = "https://api.exchangeratesapi.io/latest?base=INR";

        RestTemplate restTemplate = new RestTemplate();
        String result = restTemplate.getForObject(uri, String.class);
        HashMap<String, Object> resultObj = new ObjectMapper().readValue(result, HashMap.class);
        Set<String> currencyCodes = ((LinkedHashMap) resultObj.get("rates")).keySet();
        HashMap<String, String> currencyList = new HashMap<>();

        for (String currencyCode : currencyCodes) {
            Currency c = Currency.getInstance(currencyCode);
            currencyList.put(currencyCode, c.getDisplayName());
        }

        return currencyList;
    }

    public HashMap<String, String> convertRates(double amount, String from, String to) throws JsonProcessingException {
        DecimalFormat df = new DecimalFormat("####0.00");
        final String uri = "https://api.exchangeratesapi.io/latest?base="+ from +"&symbols=" + to;

        RestTemplate restTemplate = new RestTemplate();
        String result = restTemplate.getForObject(uri, String.class);
        HashMap<String, Object> resultObj = new ObjectMapper().readValue(result, HashMap.class);
        double unitPrice = (double) ((LinkedHashMap) resultObj.get("rates")).get(to);

        HashMap<String, String> converted = new HashMap<String, String>(){{
           put("fromUnitPrice", "1 " + from);
           put("toUnitPrice", String.valueOf(Math.round(unitPrice * 100.0) / 100.0) + " " + to);
           put("convertedPrice", amount + " " +  Currency.getInstance(from).getDisplayName() + " equals to " + Math.round((amount * unitPrice) * 100.0) / 100.0 + " " + Currency.getInstance(to).getDisplayName());
        }};

        return converted;
    }

}
