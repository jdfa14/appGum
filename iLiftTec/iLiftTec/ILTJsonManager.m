//
//  ILTJsonManager.m
//  iLiftTec
//
//  Created by Ivan Diaz on 5/18/14.
//  Copyright (c) 2014 Ivan Diaz. All rights reserved.
//

#import "ILTJsonManager.h"

@implementation ILTJsonManager


-(id)init {
    self = [super init];
    return self;
}

-(NSDictionary*) jsonHandler:(NSString *)servidor parametros:(NSString*)parametros{
    @try {
        NSDictionary *jsonData = nil;
        NSURL *url=[NSURL URLWithString:servidor];
        NSData *postData = [parametros dataUsingEncoding:NSASCIIStringEncoding allowLossyConversion:YES];
        NSString *postLength = [NSString stringWithFormat:@"%d", [postData length]];
        NSMutableURLRequest *request = [[NSMutableURLRequest alloc] init];
        [request setURL:url];
        [request setHTTPMethod:@"POST"];
        [request setValue:postLength forHTTPHeaderField:@"Content-Length"];
        [request setValue:@"application/json" forHTTPHeaderField:@"Accept"];
        [request setValue:@"application/x-www-form-urlencoded" forHTTPHeaderField:@"Content-Type"];
        [request setHTTPBody:postData];
        NSError *error = [[NSError alloc] init];
        NSHTTPURLResponse *response = nil;
        NSData *urlData=[NSURLConnection sendSynchronousRequest:request returningResponse:&response error:&error];
        if ([response statusCode] >=200 && [response statusCode] <300)
        {
            NSString *responseData = [[NSString alloc]initWithData:urlData encoding:NSUTF8StringEncoding];
            SBJsonParser *jsonParser = [SBJsonParser new];
            jsonData = (NSDictionary *) [jsonParser objectWithString:responseData error:nil];
        }
        return jsonData;
    }
    @catch (NSException *exception) {
        return nil;
    }
}


@end
