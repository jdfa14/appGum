//
//  ILTJsonManager.h
//  iLiftTec
//
//  Created by Ivan Diaz on 5/18/14.
//  Copyright (c) 2014 Ivan Diaz. All rights reserved.
//

#import <Foundation/Foundation.h>
#import "SBJson.h"

@interface ILTJsonManager : NSObject

-(id) init;

-(NSDictionary*) jsonHandler:(NSString *)servidor parametros:(NSString*)parametros;

@end
